<?php
$page_title = "Add New Service";
require_once '../partials/header.php';
require_once '../../database.php';

// Access control
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("location: /login.php");
    exit;
}

$name = $description = $price = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $sql = "INSERT INTO services (name, description, price) VALUES (:name, :description, :price)";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);

            if ($stmt->execute()) {
                header("location: services.php");
                exit();
            } else {
                $errors['form'] = "Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }
    unset($pdo);
}
?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold font-display text-accent mb-6">Add New Service</h1>
    <div class="max-w-2xl mx-auto bg-card-bg p-8 rounded-lg border border-border-color">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                <button type="submit" class="bg-accent text-background font-bold py-3 px-6 rounded-md hover:bg-yellow-400 transition-colors">Add Service</button>
                <a href="services.php" class="ml-4 text-secondary hover:text-primary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php
require_once '../partials/footer.php';
?>
