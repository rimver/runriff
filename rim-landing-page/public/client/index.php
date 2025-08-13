<?php
$page_title = "Client Dashboard";
require_once '../partials/header.php';
require_once '../../database.php';

// Access control: Must be logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /login.php");
    exit;
}

// Fetch user's orders
$user_id = $_SESSION['id'];
$sql = "SELECT
            orders.id,
            orders.order_date,
            orders.status,
            services.name as service_name,
            services.price as service_price
        FROM orders
        JOIN services ON orders.service_id = services.id
        WHERE orders.user_id = :user_id
        ORDER BY orders.order_date DESC";

$orders = [];
if ($stmt = $pdo->prepare($sql)) {
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $orders = $stmt->fetchAll();
    unset($stmt);
}
unset($pdo);
?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold font-display text-accent mb-6">Client Dashboard</h1>
    <div class="bg-card-bg p-6 rounded-lg border border-border-color">
        <p class="text-primary">Welcome, <span class="font-bold"><?php echo htmlspecialchars($_SESSION["name"]); ?></span>!</p>
        <p class="text-secondary mt-2">Here you can view your ordered services and manage your account.</p>

        <div class="mt-8">
            <h2 class="text-2xl font-bold text-primary mb-4">Your Order History</h2>
            <div class="bg-background/50 rounded-lg border border-border-color overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-secondary">
                        <thead>
                            <tr class="border-b border-border-color">
                                <th class="p-4">Service Name</th>
                                <th class="p-4">Order Date</th>
                                <th class="p-4">Price</th>
                                <th class="p-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($orders)): ?>
                                <tr>
                                    <td colspan="4" class="text-center p-6">You have not ordered any services yet.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($orders as $order): ?>
                                    <tr class="border-b border-border-color/50">
                                        <td class="p-4 font-medium text-primary"><?php echo htmlspecialchars($order['service_name']); ?></td>
                                        <td class="p-4"><?php echo date("d M Y, H:i", strtotime($order['order_date'])); ?></td>
                                        <td class="p-4">Rp <?php echo number_format($order['service_price'], 0, ',', '.'); ?></td>
                                        <td class="p-4">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full <?php
                                                switch ($order['status']) {
                                                    case 'pending': echo 'bg-yellow-500/20 text-yellow-300'; break;
                                                    case 'completed': echo 'bg-green-500/20 text-green-300'; break;
                                                    case 'cancelled': echo 'bg-red-500/20 text-red-300'; break;
                                                    default: echo 'bg-gray-500/20 text-gray-300';
                                                }
                                            ?>">
                                                <?php echo htmlspecialchars(ucfirst($order['status'])); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

         <div class="mt-8">
            <a href="/services.php" class="inline-block bg-accent text-background font-bold py-3 px-6 rounded-md hover:bg-yellow-400 transition-colors">
                Browse More Services
            </a>
        </div>
    </div>
</div>

<?php
require_once '../partials/footer.php';
?>
