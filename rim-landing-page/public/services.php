<?php
$page_title = "Our Services";
require_once 'partials/header.php';
require_once '../database.php';

// Fetch all services from the database
$sql = "SELECT * FROM services ORDER BY name ASC";
$services = $pdo->query($sql)->fetchAll();
?>

<div class="container mx-auto p-6">
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-display font-bold text-primary shimmer-effect">Our Services</h1>
        <p class="text-lg text-secondary max-w-3xl mx-auto mt-4">We provide end-to-end technology solutions to empower your business.</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (empty($services)): ?>
            <p class="text-center text-secondary md:col-span-3">No services are available at this time. Please check back later.</p>
        <?php else: ?>
            <?php foreach ($services as $service): ?>
                <div class="service-card bg-card-bg rounded-lg border border-border-color p-6 flex flex-col hover:border-accent transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex-grow">
                        <h3 class="font-display font-bold text-xl text-primary mb-3"><?php echo htmlspecialchars($service['name']); ?></h3>
                        <p class="text-secondary mb-4 text-sm leading-relaxed"><?php echo nl2br(htmlspecialchars($service['description'])); ?></p>
                    </div>
                    <div class="mt-auto pt-4">
                        <div class="text-accent font-bold text-2xl mb-4">
                            Rp <?php echo number_format($service['price'], 0, ',', '.'); ?>
                        </div>
                        <a href="order.php?service_id=<?php echo $service['id']; ?>" class="block text-center w-full bg-accent text-background py-2 px-4 rounded-md hover:bg-yellow-400 transition-colors font-medium">
                            Order Now
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php
require_once 'partials/footer.php';
unset($pdo);
?>
