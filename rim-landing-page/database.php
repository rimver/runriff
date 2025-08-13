<?php

// Include the configuration file
require_once 'config.php';

/*
 * ---------------------------------------------------------------
 * DATABASE CONNECTION
 * ---------------------------------------------------------------
 *
 * This file creates a new PDO object to connect to the MySQL
 * database. It uses the credentials defined in config.php.
 *
 * The connection object is stored in the $pdo variable and can be
 * included in other scripts to perform database operations.
 */

try {
    // Create a new PDO instance
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Use native prepared statements
    ];

    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);

} catch (PDOException $e) {
    // If the connection fails, stop the script and display an error.
    // In a production environment, you would want to log this error
    // and show a more user-friendly message.
    die("ERROR: Could not connect to the database. " . $e->getMessage());
}

?>
