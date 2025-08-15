<?php
session_start();

// If user is already logged in, redirect to their dashboard
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    if ($_SESSION["role"] === 'admin') {
        header("location: admin/index.php");
    } else {
        header("location: client/index.php");
    }
    exit;
}

require_once '../database.php';

$email = $password = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('CSRF token validation failed.');
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $errors['email'] = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $errors['password'] = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // If no validation errors, proceed
    if (empty($errors)) {
        $sql = "SELECT id, name, email, password, role FROM users WHERE email = :email";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $name = $row["name"];
                        $hashed_password = $row["password"];
                        $role = $row["role"];

                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["name"] = $name;
                            $_SESSION["email"] = $email;
                            $_SESSION["role"] = $role;

                            // Redirect user to their respective dashboard
                            if ($role === 'admin') {
                                header("location: admin/index.php");
                            } else {
                                header("location: client/index.php");
                            }
                            exit();
                        } else {
                            $errors['password'] = "The password you entered was not valid.";
                        }
                    }
                } else {
                    $errors['email'] = "No account found with that email.";
                }
            } else {
                $errors['form'] = "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - R/I/M Technology</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-background text-primary">
    <div class="container mx-auto mt-12 p-6">
        <div class="max-w-md mx-auto bg-card-bg p-8 rounded-lg border border-border-color">
            <h2 class="text-3xl font-bold font-display text-center text-accent mb-6">Client Portal Login</h2>

            <?php
            if(!empty($errors['form'])){
                echo '<div class="bg-red-500/20 text-red-300 p-3 rounded-md mb-4">' . $errors['form'] . '</div>';
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div class="mb-4">
                    <label for="email" class="block text-secondary text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" class="w-full bg-background border <?php echo (!empty($errors['email'])) ? 'border-red-500' : 'border-border-color'; ?> rounded-md p-3 text-primary focus:ring-2 focus:ring-accent">
                    <?php if(!empty($errors['email'])): ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo $errors['email']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-secondary text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" class="w-full bg-background border <?php echo (!empty($errors['password'])) ? 'border-red-500' : 'border-border-color'; ?> rounded-md p-3 text-primary focus:ring-2 focus:ring-accent">
                    <?php if(!empty($errors['password'])): ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo $errors['password']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="w-full bg-accent text-background font-bold py-3 px-6 rounded-md hover:bg-yellow-400 transition-colors">Login</button>
                </div>
                 <p class="text-center text-secondary text-sm mt-6">
                    Don't have an account? <a href="register.php" class="text-accent hover:underline">Register here</a>.
                </p>
            </form>
        </div>
    </div>
</body>
</html>
