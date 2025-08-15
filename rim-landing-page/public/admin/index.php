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

    <!-- Database Status Check -->
    <div class="bg-card-bg p-6 rounded-lg border border-border-color mb-6">
        <h2 class="text-xl font-bold text-primary mb-4">System Status Check</h2>
        <?php
        // We need to re-require the database file to check the $pdo object
        require_once '../../database.php';

        if ($pdo) {
            echo '<p class="text-green-400 mb-2"><i class="bi bi-check-circle-fill mr-2"></i>Database Connection: OK</p>';
            $tables_to_check = ['users', 'services', 'orders', 'content'];
            $all_tables_found = true;
            foreach ($tables_to_check as $table) {
                try {
                    $result = $pdo->query("SELECT 1 FROM {$table} LIMIT 1");
                    if ($result) {
                        echo '<p class="text-green-400 mb-1"><i class="bi bi-check-circle mr-2"></i>Table \''.htmlspecialchars($table).'\': Found</p>';
                    }
                } catch (Exception $e) {
                    echo '<p class="text-red-400 mb-1"><i class="bi bi-x-circle mr-2"></i>Table \''.htmlspecialchars($table).'\': NOT FOUND. Please run the setup script.</p>';
                    $all_tables_found = false;
                }
            }
            if ($all_tables_found) {
                 echo '<p class="text-secondary text-sm mt-4">Run <a href="/setup.php" target="_blank" class="text-accent underline">setup.php</a> again to reset tables (use with caution).</p>';
            } else {
                 echo '<p class="text-yellow-400 text-sm mt-4">One or more tables are missing. Please <a href="/setup.php" target="_blank" class="text-accent underline">run the setup script</a> to create them.</p>';
            }
        } else {
            echo '<p class="text-red-400 mb-2"><i class="bi bi-x-circle-fill mr-2"></i>Database Connection: FAILED</p>';
            echo '<p class="text-secondary text-sm">Could not connect to the database. Please check the credentials in `config.php` and ensure the database server is running and accessible.</p>';
        }
        ?>
    </div>

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
            <a href="content.php" class="bg-background/50 p-6 rounded-lg border border-border-color hover:border-accent transition-colors">
                <h2 class="text-xl font-bold text-primary mb-2"><i class="bi bi-pencil-square mr-2"></i>Manage Content</h2>
                <p class="text-secondary">Edit the text content of the main website pages.</p>
            </a>
        </div>
    </div>
</div>

<?php
require_once '../partials/footer.php';
?>
