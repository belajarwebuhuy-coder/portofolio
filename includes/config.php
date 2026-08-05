<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Config
 * Description : Global configuration and constants
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

// -----------------------------------------------------
// Paths
// -----------------------------------------------------
define('ROOT_PATH', str_replace('\\', '/', dirname(__DIR__)));
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('UPLOAD_PATH', ROOT_PATH . '/uploads');
define('ADMIN_PATH', ROOT_PATH . '/admin');

// -----------------------------------------------------
// Base URL
// -----------------------------------------------------
if (!defined('BASE_URL')) {
    // Compute base URL from the physical project root relative to the document root.
    // This always resolves to the project root regardless of which file is accessed.
    $docRoot = str_replace('\\', '/', rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/'));
    $baseDir = $docRoot !== '' && strpos(ROOT_PATH, $docRoot) === 0
        ? substr(ROOT_PATH, strlen($docRoot))
        : ROOT_PATH;
    define('BASE_URL', rtrim($baseDir, '/'));
}

// -----------------------------------------------------
// Database Credentials
// -----------------------------------------------------
define('DB_HOST', '');
define('DB_NAME', 'portfolio_cms');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');
// define('DB_HOST', 'sql312.infinityfree.com');
// define('DB_NAME', 'if0_42579626_portofolio');
// define('DB_USER', 'if0_42579626');
// define('DB_PASS', 'Bx6oNf7wc3kKlV');
// define('DB_CHARSET', 'utf8mb4');

// -----------------------------------------------------
// App Constants
// -----------------------------------------------------
define('APP_NAME', 'Personal Portfolio CMS');
define('SESSION_NAME', 'portfolio_cms_session');
define('UPLOAD_MAX_SIZE', 5 * 1024 * 1024); // 5MB
define('PAGE_SIZE', 10);

// -----------------------------------------------------
// Allowed Image Types
// -----------------------------------------------------
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/webp']);
define('ALLOWED_IMAGE_EXT', ['jpg', 'jpeg', 'png', 'webp']);

// -----------------------------------------------------
// Start Session
// -----------------------------------------------------
if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_start();
}

// -----------------------------------------------------
// Timezone
// -----------------------------------------------------
date_default_timezone_set('Asia/Jakarta');