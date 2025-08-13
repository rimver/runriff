<?php
$page_title = "Admin Dashboard";
require_once '../partials/header.php';

// Access control
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("location: /login.php");
    exit;
}
?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold font-display text-accent mb-6">Admin Dashboard</h1>
    <div class="bg-card-bg p-6 rounded-lg border border-border-color">
        <p class="text-primary">Welcome, <span class="font-bold"><?php echo htmlspecialchars($_SESSION["name"]); ?></span>!</p>
        <p class="text-secondary mt-2">This is the central hub for managing the R/I/M Technology platform. From here, you can manage services, view orders, and oversee client accounts.</p>

        <div class="mt-6 grid md:grid-cols-2 gap-6">
            <a href="services.php" class="bg-background/50 p-6 rounded-lg border border-border-color hover:border-accent transition-colors">
                <h2 class="text-xl font-bold text-primary mb-2"><i class="bi bi-wrench-adjustable-circle-fill mr-2"></i>Manage Services</h2>
                <p class="text-secondary">Add, edit, or remove the IT services offered to clients.</p>
            </a>
            <a href="orders.php" class="bg-background/50 p-6 rounded-lg border border-border-color hover:border-accent transition-colors">
                <h2 class="text-xl font-bold text-primary mb-2"><i class="bi bi-box-seam-fill mr-2"></i>View Orders</h2>
                <p class="text-secondary">See all client orders and manage their status.</p>
            </a>
        </div>
    </div>
</div>

<?php
require_once '../partials/footer.php';
?>
