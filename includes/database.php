<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

/**
 * Get the shared PDO database connection.
 *
 * @return PDO
 */
function db(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Log error, do not expose to user
            error_log('Database connection failed: ' . $e->getMessage());
            http_response_code(500);
            exit('Koneksi database gagal. Silakan periksa konfigurasi.');
        }
    }

    return $pdo;
}