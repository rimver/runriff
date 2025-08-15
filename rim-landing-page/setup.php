<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

    // SQL statement for creating the content table
    $sql_content = "
    CREATE TABLE IF NOT EXISTS content (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        content_key VARCHAR(100) NOT NULL UNIQUE,
        content_value TEXT,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $pdo->exec($sql_content);
    echo "Table 'content' created or already exists.\n";

    // Insert default content, ignoring if keys already exist
    $default_content = [
        'hero_title' => 'Bisnis Anda Punya Potensi. Kami Punya Teknologinya.',
        'hero_subtitle' => 'Lupakan kerumitan teknis. Kami adalah mitra teknologi satu pintu yang membereskan semuanya—dari instalasi fisik hingga inovasi digital—agar Anda bisa fokus pada hal terpenting: mengembangkan bisnis.'
    ];

    $sql_insert = "INSERT IGNORE INTO content (content_key, content_value) VALUES (:key, :value)";
    $stmt = $pdo->prepare($sql_insert);

    foreach ($default_content as $key => $value) {
        $stmt->execute(['key' => $key, 'value' => $value]);
    }
    echo "Default content inserted or already exists.\n";


    echo "\nDatabase setup completed successfully!\n";

} catch (PDOException $e) {
    // If an error occurs, print it out
    die("ERROR: Could not execute setup script. " . $e->getMessage());
}

// Close connection
unset($pdo);

?>
