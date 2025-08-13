<?php
$page_title = "Manage Website Content";
require_once '../partials/header.php';
require_once '../../database.php';

// Access control
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("location: /login.php");
    exit;
}

$success_message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['content']) && is_array($_POST['content'])) {
        $sql = "UPDATE content SET content_value = :value WHERE content_key = :key";
        $stmt = $pdo->prepare($sql);

        foreach ($_POST['content'] as $key => $value) {
            $stmt->execute(['key' => $key, 'value' => $value]);
        }
        $success_message = "Content updated successfully!";
    }
}

// Fetch all content from the database
$content_sql = "SELECT content_key, content_value FROM content";
$contents = $pdo->query($content_sql)->fetchAll(PDO::FETCH_KEY_PAIR);
?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold font-display text-accent mb-6">Manage Website Content</h1>

    <?php if ($success_message): ?>
        <div class="bg-green-500/20 text-green-300 p-4 rounded-md mb-6">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <div class="bg-card-bg p-8 rounded-lg border border-border-color">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="space-y-6">
                <?php foreach ($contents as $key => $value): ?>
                    <div>
                        <label for="<?php echo htmlspecialchars($key); ?>" class="block text-secondary text-sm font-bold mb-2 capitalize"><?php echo str_replace('_', ' ', htmlspecialchars($key)); ?></label>
                        <?php if (strlen($value) > 255): ?>
                            <textarea name="content[<?php echo htmlspecialchars($key); ?>]" id="<?php echo htmlspecialchars($key); ?>" rows="5" class="w-full bg-background border border-border-color rounded-md p-3 text-primary focus:ring-2 focus:ring-accent"><?php echo htmlspecialchars($value); ?></textarea>
                        <?php else: ?>
                            <input type="text" name="content[<?php echo htmlspecialchars($key); ?>]" id="<?php echo htmlspecialchars($key); ?>" value="<?php echo htmlspecialchars($value); ?>" class="w-full bg-background border border-border-color rounded-md p-3 text-primary focus:ring-2 focus:ring-accent">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-8">
                <button type="submit" class="bg-accent text-background font-bold py-3 px-6 rounded-md hover:bg-yellow-400 transition-colors">Save Content</button>
            </div>
        </form>
    </div>
</div>

<?php
require_once '../partials/footer.php';
unset($pdo);
?>
