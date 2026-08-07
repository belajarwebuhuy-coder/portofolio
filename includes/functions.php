<?php
declare(strict_types=1);

require_once __DIR__ . '/database.php';

/**
 * Escape output for safe HTML display (XSS protection).
 *
 * @param mixed $value
 * @return string
 */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/**
 * Build a URL based on the base URL.
 *
 * @param string $path
 * @return string
 */
function url(string $path = ''): string
{
    return BASE_URL . '/' . ltrim($path, '/');
}

/**
 * Generate a slug from a string.
 *
 * @param string $text
 * @return string
 */
function slugify(string $text): string
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    $text = trim($text, '-');
    return $text !== '' ? $text : 'item-' . time();
}

/**
 * Generate a unique filename for uploads.
 *
 * @param string $extension
 * @return string
 */
function uniqueFilename(string $extension): string
{
    return date('Ymd-His') . '-' . bin2hex(random_bytes(3)) . '.' . $extension;
}

/**
 * Get file extension from a path.
 *
 * @param string $filename
 * @return string
 */
function getExtension(string $filename): string
{
    return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
}

/**
 * Check if a file is a valid image upload.
 *
 * @param array $file $_FILES entry
 * @return bool
 */
function isValidImage(array $file): bool
{
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    $mime = mime_content_type($file['tmp_name']);
    $ext  = getExtension($file['name']);

    return in_array($mime, ALLOWED_IMAGE_TYPES, true)
        && in_array($ext, ALLOWED_IMAGE_EXT, true)
        && $file['size'] <= UPLOAD_MAX_SIZE;
}

/**
 * Handle image upload and return generated filename or null.
 *
 * @param array $file    $_FILES entry
 * @param string $folder Upload subfolder (e.g. 'hero')
 * @param string|null $oldFile Optional old file to delete
 * @return string|null
 */
function uploadImage(array $file, string $folder, ?string $oldFile = null): ?string
{
    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
        return $oldFile;
    }

    if (!isValidImage($file)) {
        return null;
    }

    $dir = UPLOAD_PATH . '/' . $folder;
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    $ext  = getExtension($file['name']);
    $name = uniqueFilename($ext);

    if (!move_uploaded_file($file['tmp_name'], $dir . '/' . $name)) {
        return null;
    }

    // Delete old file if exists and different
    if ($oldFile && $oldFile !== $name && is_file($dir . '/' . $oldFile)) {
        unlink($dir . '/' . $oldFile);
    }

    return $name;
}

/**
 * Delete an uploaded file.
 *
 * @param string $folder
 * @param string|null $filename
 * @return void
 */
function deleteUpload(string $folder, ?string $filename): void
{
    if (!$filename) {
        return;
    }
    $path = UPLOAD_PATH . '/' . $folder . '/' . $filename;
    if (is_file($path)) {
        unlink($path);
    }
}

/**
 * Redirect to a URL.
 *
 * @param string $path
 * @return void
 */
function redirect(string $path): void
{
    header('Location: ' . url($path));
    exit;
}

/**
 * Set a flash message.
 *
 * @param string $type (success|danger|warning|info)
 * @param string $message
 * @return void
 */
function setFlash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

/**
 * Get and clear the flash message.
 *
 * @return array|null
 */
function getFlash(): ?array
{
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

/**
 * Generate a CSRF token and store it in session.
 *
 * @return string
 */
function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify a CSRF token.
 *
 * @param string|null $token
 * @return bool
 */
function csrfVerify(?string $token): bool
{
    return isset($_SESSION['csrf_token'])
        && is_string($token)
        && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Render a hidden CSRF input field.
 *
 * @return string
 */
function csrfField(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrfToken()) . '">';
}

/**
 * Get current settings record (single row).
 *
 * @return array
 */
function getSettings(): array
{
    $stmt = db()->prepare('SELECT * FROM settings WHERE id = 1 LIMIT 1');
    $stmt->execute();
    return $stmt->fetch() ?: [];
}

/**
 * Get the current logged-in user.
 *
 * @return array|null
 */
function currentUser(): ?array
{
    if (empty($_SESSION['user_id'])) {
        return null;
    }

    $stmt = db()->prepare('SELECT id, name, email, photo FROM users WHERE id = ? LIMIT 1');
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch() ?: null;
}

/**
 * Format a timestamp for display.
 *
 * @param string|null $datetime
 * @param string $format
 * @return string
 */
function formatDate(?string $datetime, string $format = 'd M Y'): string
{
    if (!$datetime) {
        return '-';
    }
    $ts = strtotime($datetime);
    return $ts ? date($format, $ts) : '-';
}

/**
 * Truncate a string to a given length.
 *
 * @param string $text
 * @param int $length
 * @return string
 */
function truncate(string $text, int $length = 100): string
{
    if (mb_strlen($text) <= $length) {
        return $text;
    }
    return mb_substr($text, 0, $length) . '...';
}

/**
 * Convert a JSON string to array (for tech_stack / tags).
 *
 * @param string|null $json
 * @return array
 */
function jsonToArray(?string $json): array
{
    if (!$json) {
        return [];
    }
    $decoded = json_decode($json, true);
    return is_array($decoded) ? $decoded : [];
}

/**
 * Convert an array to JSON string.
 *
 * @param array $array
 * @return string
 */
function arrayToJson(array $array): string
{
    return json_encode($array, JSON_UNESCAPED_UNICODE);
}

/**
 * Basic CSRF + validation middleware for POST forms.
 *
 * @return void
 */
function requireCsrf(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect('admin/');
    }

    $token = $_POST['csrf_token'] ?? null;
    if (!csrfVerify($token)) {
        http_response_code(419);
        exit('CSRF token tidak valid.');
    }
}