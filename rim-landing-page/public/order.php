<?php
session_start();
require_once '../database.php';

// Check if user is logged in. If not, redirect to login page.
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Store the intended destination in the session
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("location: login.php");
    exit;
}

// Check if a service_id is provided
if (isset($_GET['service_id']) && !empty($_GET['service_id'])) {
    $service_id = $_GET['service_id'];
    $user_id = $_SESSION['id'];

    // Prepare an insert statement
    $sql = "INSERT INTO orders (user_id, service_id, status) VALUES (:user_id, :service_id, 'pending')";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);

        // Attempt to execute
        if ($stmt->execute()) {
            // Order created successfully. Redirect to client dashboard.
            header("location: client/index.php?order=success");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    unset($stmt);
} else {
    // If no service_id is provided, redirect to services page
    header("location: services.php");
    exit();
}

unset($pdo);
?>
