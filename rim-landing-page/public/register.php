<?php
session_start();
require_once '../database.php';

$name = $email = $password = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate name
    if (empty(trim($_POST["name"]))) {
        $errors['name'] = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Sanitize and validate email
    if (empty(trim($_POST["email"]))) {
        $errors['email'] = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format.";
        } else {
            // Check if email is already taken
            $sql = "SELECT id FROM users WHERE email = :email";
            if ($stmt = $pdo->prepare($sql)) {
                $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        $errors['email'] = "This email is already taken.";
                    }
                } else {
                    $errors['form'] = "Oops! Something went wrong. Please try again later.";
                }
                unset($stmt);
            }
        }
    }

    // Sanitize and validate password
    if (empty(trim($_POST["password"]))) {
        $errors['password'] = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $errors['password'] = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // If there are no errors, insert into database
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Redirect to login page
                header("location: login.php");
                exit();
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
    <title>Register - R/I/M Technology</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-background text-primary">
    <div class="container mx-auto mt-12 p-6">
        <div class="max-w-md mx-auto bg-card-bg p-8 rounded-lg border border-border-color">
            <h2 class="text-3xl font-bold font-display text-center text-accent mb-6">Create Account</h2>

            <?php
            if(!empty($errors['form'])){
                echo '<div class="bg-red-500/20 text-red-300 p-3 rounded-md mb-4">' . $errors['form'] . '</div>';
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-4">
                    <label for="name" class="block text-secondary text-sm font-bold mb-2">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" class="w-full bg-background border <?php echo (!empty($errors['name'])) ? 'border-red-500' : 'border-border-color'; ?> rounded-md p-3 text-primary focus:ring-2 focus:ring-accent">
                    <?php if(!empty($errors['name'])): ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo $errors['name']; ?></p>
                    <?php endif; ?>
                </div>
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
                    <button type="submit" class="w-full bg-accent text-background font-bold py-3 px-6 rounded-md hover:bg-yellow-400 transition-colors">Register</button>
                </div>
                <p class="text-center text-secondary text-sm mt-6">
                    Already have an account? <a href="login.php" class="text-accent hover:underline">Login here</a>.
                </p>
            </form>
        </div>
    </div>
</body>
</html>
