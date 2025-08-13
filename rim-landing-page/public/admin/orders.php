<?php
$page_title = "Manage Orders";
require_once '../partials/header.php';
require_once '../../database.php';

// Access control
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("location: /login.php");
    exit;
}

$success_message = '';
$error_message = '';

// Handle status update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];
    $allowed_statuses = ['pending', 'in-progress', 'completed', 'cancelled'];

    if (in_array($new_status, $allowed_statuses)) {
        $sql_update = "UPDATE orders SET status = :status WHERE id = :id";
        if ($stmt_update = $pdo->prepare($sql_update)) {
            $stmt_update->bindParam(':status', $new_status, PDO::PARAM_STR);
            $stmt_update->bindParam(':id', $order_id, PDO::PARAM_INT);
            if ($stmt_update->execute()) {
                $success_message = "Order #" . $order_id . " status updated successfully!";
            } else {
                $error_message = "Failed to update order status.";
            }
        }
    } else {
        $error_message = "Invalid status value.";
    }
}

// Fetch all orders with user and service details
$sql = "SELECT
            orders.id,
            orders.order_date,
            orders.status,
            users.name as user_name,
            users.email as user_email,
            services.name as service_name,
            services.price as service_price
        FROM orders
        JOIN users ON orders.user_id = users.id
        JOIN services ON orders.service_id = services.id
        ORDER BY orders.order_date DESC";
$orders = $pdo->query($sql)->fetchAll();
?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold font-display text-accent mb-6">Manage Client Orders</h1>

    <?php if ($success_message): ?>
        <div class="bg-green-500/20 text-green-300 p-4 rounded-md mb-6"><?php echo $success_message; ?></div>
    <?php endif; ?>
    <?php if ($error_message): ?>
        <div class="bg-red-500/20 text-red-300 p-4 rounded-md mb-6"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <div class="bg-card-bg p-6 rounded-lg border border-border-color">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-secondary">
                <thead>
                    <tr class="border-b border-border-color">
                        <th class="p-4">Order ID</th>
                        <th class="p-4">Client</th>
                        <th class="p-4">Service</th>
                        <th class="p-4">Date</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="6" class="text-center p-6">No orders found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr class="border-b border-border-color/50">
                                <td class="p-4 font-medium text-primary">#<?php echo $order['id']; ?></td>
                                <td class="p-4">
                                    <div class="font-medium text-primary"><?php echo htmlspecialchars($order['user_name']); ?></div>
                                    <div class="text-xs"><?php echo htmlspecialchars($order['user_email']); ?></div>
                                </td>
                                <td class="p-4"><?php echo htmlspecialchars($order['service_name']); ?></td>
                                <td class="p-4"><?php echo date("d M Y", strtotime($order['order_date'])); ?></td>
                                <td class="p-4">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full <?php
                                        switch ($order['status']) {
                                            case 'pending': echo 'bg-yellow-500/20 text-yellow-300'; break;
                                            case 'in-progress': echo 'bg-blue-500/20 text-blue-300'; break;
                                            case 'completed': echo 'bg-green-500/20 text-green-300'; break;
                                            case 'cancelled': echo 'bg-red-500/20 text-red-300'; break;
                                            default: echo 'bg-gray-500/20 text-gray-300';
                                        }
                                    ?>">
                                        <?php echo htmlspecialchars(ucfirst($order['status'])); ?>
                                    </span>
                                </td>
                                <td class="p-4">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="flex items-center gap-2">
                                        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                        <select name="status" class="bg-background border border-border-color rounded-md p-2 text-sm">
                                            <option value="pending" <?php if($order['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                            <option value="in-progress" <?php if($order['status'] == 'in-progress') echo 'selected'; ?>>In Progress</option>
                                            <option value="completed" <?php if($order['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                                            <option value="cancelled" <?php if($order['status'] == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                                        </select>
                                        <button type="submit" name="update_status" class="bg-accent text-background font-bold py-2 px-3 rounded-md text-sm hover:bg-yellow-400 transition-colors">Update</button>
                                    </form>
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
