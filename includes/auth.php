<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Auth
 * Description : Authentication helpers and middleware
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/functions.php';

/**
 * Check if the user is logged in.
 *
 * @return bool
 */
function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

/**
 * Redirect to login if user is not authenticated.
 *
 * @return void
 */
function requireLogin(): void
{
    if (!isLoggedIn()) {
        redirect('admin/login.php');
    }
}

/**
 * Redirect to dashboard if user is already logged in.
 *
 * @return void
 */
function redirectIfLoggedIn(): void
{
    if (isLoggedIn()) {
        redirect('admin/dashboard.php');
    }
}

/**
 * Attempt to authenticate a user.
 *
 * @param string $email
 * @param string $password
 * @return bool
 */
function attemptLogin(string $email, string $password): bool
{
    $stmt = db()->prepare('SELECT id, name, email, password FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
        return false;
    }

    // Regenerate session ID to prevent session fixation
    session_regenerate_id(true);

    $_SESSION['user_id'] = (int) $user['id'];
    $_SESSION['user_name'] = $user['name'];

    return true;
}

/**
 * Log out the current user.
 *
 * @return void
 */
function logout(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    session_destroy();
}