<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed.');
}

// Honeypot field - if filled, it's a bot
if (!empty($_POST['website'])) {
    // Silently pretend success
    http_response_code(200);
    exit('OK');
}

// Rate limiting: simple session-based, max 5 submissions per 10 minutes
$now = time();
$window = 600; // 10 minutes
$maxSubmissions = 5;

if (!isset($_SESSION['contact_attempts'])) {
    $_SESSION['contact_attempts'] = [];
}

// Clean old attempts
$_SESSION['contact_attempts'] = array_values(array_filter(
    $_SESSION['contact_attempts'],
    fn($t) => ($now - $t) < $window
));

if (count($_SESSION['contact_attempts']) >= $maxSubmissions) {
    http_response_code(429);
    exit('Too many requests. Please try again later.');
}

// Validate input
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

$errors = [];

if ($name === '' || mb_strlen($name) > 150) {
    $errors[] = 'Name is required (max 150 characters).';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
    $errors[] = 'A valid email is required.';
}
if ($subject !== '' && mb_strlen($subject) > 255) {
    $errors[] = 'Subject is too long.';
}
if ($message === '' || mb_strlen($message) > 5000) {
    $errors[] = 'Message is required (max 5000 characters).';
}

if ($errors) {
    http_response_code(422);
    header('Content-Type: application/json');
    echo json_encode(['errors' => $errors]);
    exit;
}

// Record attempt
$_SESSION['contact_attempts'][] = $now;

// Store message (sanitized strings via prepared statement)
$stmt = db()->prepare('INSERT INTO messages (name, email, subject, message) VALUES (?,?,?,?)');
$stmt->execute([$name, $email, $subject, $message]);

header('Content-Type: application/json');
echo json_encode(['success' => 'Your message has been sent. Thank you!']);