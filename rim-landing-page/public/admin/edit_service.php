<?php
$page_title = "Edit Service";
require_once '../partials/header.php';
require_once '../../database.php';

// Access control
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("location: /login.php");
    exit;
}

$name = $description = $price = '';
$service_id = $_GET['id'] ?? null;
$errors = [];

if (!$service_id) {
    header("location: services.php");
    exit;
}

// Fetch the service to edit
$sql_fetch = "SELECT * FROM services WHERE id = :id";
if ($stmt_fetch = $pdo->prepare($sql_fetch)) {
    $stmt_fetch->bindParam(':id', $service_id, PDO::PARAM_INT);
    $stmt_fetch->execute();
    if ($service = $stmt_fetch->fetch()) {
        $name = $service['name'];
        $description = $service['description'];
        $price = $service['price'];
    } else {
        // No service found with that id
        header("location: services.php");
        exit;
    }
    unset($stmt_fetch);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('CSRF token validation failed.');
    }

    // Validate name
    if (empty(trim($_POST['name']))) {
        $errors['name'] = 'Please enter a service name.';
    } else {
        $name = trim($_POST['name']);
    }

    // Validate description
    if (empty(trim($_POST['description']))) {
        $errors['description'] = 'Please enter a description.';
    } else {
        $description = trim($_POST['description']);
    }

    // Validate price
    if (empty(trim($_POST['price']))) {
        $errors['price'] = 'Please enter a price.';
    } elseif (!is_numeric($_POST['price'])) {
        $errors['price'] = 'Price must be a number.';
    } else {
        $price = trim($_POST['price']);
    }

    if (empty($errors)) {
        $sql_update = "UPDATE services SET name = :name, description = :description, price = :price WHERE id = :id";
        if ($stmt_update = $pdo->prepare($sql_update)) {
            $stmt_update->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt_update->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt_update->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt_update->bindParam(':id', $service_id, PDO::PARAM_INT);

            if ($stmt_update->execute()) {
                header("location: services.php");
                exit();
            } else {
                $errors['form'] = "Something went wrong. Please try again later.";
            }
            unset($stmt_update);
        }
    }
}
unset($pdo);
?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold font-display text-accent mb-6">Edit Service</h1>
    <div class="max-w-2xl mx-auto bg-card-bg p-8 rounded-lg border border-border-color">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $service_id; ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="mb-4">
                <label for="name" class="block text-secondary text-sm font-bold mb-2">Service Name</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" class="w-full bg-background border <?php echo (!empty($errors['name'])) ? 'border-red-500' : 'border-border-color'; ?> rounded-md p-3 text-primary focus:ring-2 focus:ring-accent">
                <?php if(!empty($errors['name'])): ?><p class="text-red-500 text-xs mt-1"><?php echo $errors['name']; ?></p><?php endif; ?>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-secondary text-sm font-bold mb-2">Description</label>
                <textarea name="description" id="description" rows="5" class="w-full bg-background border <?php echo (!empty($errors['description'])) ? 'border-red-500' : 'border-border-color'; ?> rounded-md p-3 text-primary focus:ring-2 focus:ring-accent"><?php echo htmlspecialchars($description); ?></textarea>
                <?php if(!empty($errors['description'])): ?><p class="text-red-500 text-xs mt-1"><?php echo $errors['description']; ?></p><?php endif; ?>
            </div>
            <div class="mb-6">
                <label for="price" class="block text-secondary text-sm font-bold mb-2">Price (Rp)</label>
                <input type="text" name="price" id="price" value="<?php echo htmlspecialchars($price); ?>" class="w-full bg-background border <?php echo (!empty($errors['price'])) ? 'border-red-500' : 'border-border-color'; ?> rounded-md p-3 text-primary focus:ring-2 focus:ring-accent">
                <?php if(!empty($errors['price'])): ?><p class="text-red-500 text-xs mt-1"><?php echo $errors['price']; ?></p><?php endif; ?>
            </div>
            <div class="flex items-center">
                <button type="submit" class="bg-accent text-background font-bold py-3 px-6 rounded-md hover:bg-yellow-400 transition-colors">Update Service</button>
                <a href="services.php" class="ml-4 text-secondary hover:text-primary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php
require_once '../partials/footer.php';
?>
