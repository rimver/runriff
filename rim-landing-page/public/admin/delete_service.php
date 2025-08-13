<?php
session_start();
require_once '../../database.php';

// Access control
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("location: /login.php");
    exit;
}

// Check if ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $service_id = $_GET['id'];

    // Prepare a delete statement
    $sql = "DELETE FROM services WHERE id = :id";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(':id', $service_id, PDO::PARAM_INT);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records deleted successfully. Redirect to landing page
            header("location: services.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    unset($stmt);
} else {
    // If no ID was provided, redirect to the services page
    header("location: services.php");
    exit();
}

unset($pdo);
?>
