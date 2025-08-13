<?php
/*
 * ---------------------------------------------------------------
 * DATABASE SETUP SCRIPT
 * ---------------------------------------------------------------
 *
 * This script creates the necessary database tables for the
 * application. It should be run once during the initial setup.
 *
 * WARNING: Running this script will attempt to create tables and
 * may fail if the tables already exist. It does not handle
 * migrations or updates.
 */

require_once 'database.php';

try {
    // SQL statement for creating the users table
    $sql_users = "
    CREATE TABLE IF NOT EXISTS users (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(50) NOT NULL DEFAULT 'client',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $pdo->exec($sql_users);
    echo "Table 'users' created or already exists.\n";

    // SQL statement for creating the services table
    $sql_services = "
    CREATE TABLE IF NOT EXISTS services (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $pdo->exec($sql_services);
    echo "Table 'services' created or already exists.\n";

    // SQL statement for creating the orders table
    $sql_orders = "
    CREATE TABLE IF NOT EXISTS orders (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        user_id INT NOT NULL,
        service_id INT NOT NULL,
        order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        status VARCHAR(50) NOT NULL DEFAULT 'pending',
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $pdo->exec($sql_orders);
    echo "Table 'orders' created or already exists.\n";

    echo "\nDatabase setup completed successfully!\n";

} catch (PDOException $e) {
    // If an error occurs, print it out
    die("ERROR: Could not execute setup script. " . $e->getMessage());
}

// Close connection
unset($pdo);

?>
