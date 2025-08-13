<?php
$page_title = "Manage Services";
require_once '../partials/header.php';
require_once '../../database.php';

// Access control
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("location: /login.php");
    exit;
}

// Fetch all services from the database
$sql = "SELECT * FROM services ORDER BY created_at DESC";
$services = $pdo->query($sql)->fetchAll();
?>

<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold font-display text-accent">Manage Services</h1>
        <a href="add_service.php" class="bg-green-500 text-white font-bold py-2 px-4 rounded-md hover:bg-green-600 transition-colors">
            <i class="bi bi-plus-circle-fill mr-2"></i>Add New Service
        </a>
    </div>

    <div class="bg-card-bg p-6 rounded-lg border border-border-color">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-secondary">
                <thead>
                    <tr class="border-b border-border-color">
                        <th class="p-4">Name</th>
                        <th class="p-4">Price</th>
                        <th class="p-4">Date Created</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($services)): ?>
                        <tr>
                            <td colspan="4" class="text-center p-6">No services found. Add one to get started!</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($services as $service): ?>
                            <tr class="border-b border-border-color/50">
                                <td class="p-4 font-medium text-primary"><?php echo htmlspecialchars($service['name']); ?></td>
                                <td class="p-4">Rp <?php echo number_format($service['price'], 2); ?></td>
                                <td class="p-4"><?php echo date("d M Y", strtotime($service['created_at'])); ?></td>
                                <td class="p-4 text-right">
                                    <a href="edit_service.php?id=<?php echo $service['id']; ?>" class="text-blue-400 hover:text-blue-300 mr-4">Edit</a>
                                    <a href="delete_service.php?id=<?php echo $service['id']; ?>" class="text-red-400 hover:text-red-300" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once '../partials/footer.php';
unset($pdo);
?>
