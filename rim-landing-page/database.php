<?php
require_once 'config.php';

/*
 * ---------------------------------------------------------------
 * DATABASE CONNECTION
 * ---------------------------------------------------------------
 * This script attempts to create a PDO object.
 * It will throw a PDOException on failure, which should be caught
 * by the script that includes it.
 */

$pdo = null; // Default to null

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);

} catch (PDOException $e) {
    // Log the error, but don't kill the entire application.
    // The calling script can check if $pdo is null.
    error_log("Database Connection Error: " . $e->getMessage());
}
?>
