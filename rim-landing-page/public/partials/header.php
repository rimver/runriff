<?php
// We need to start the session on every page that uses the header
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'R/I/M Technology'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-background text-primary">
    <div class="font-sans antialiased">
        <header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 backdrop-blur-md bg-background/95">
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <div class="logo">
                    <a href="/" class="text-2xl font-display font-bold text-accent shimmer-effect">R/I/M</a>
                </div>

                <!-- Desktop Menu -->
                <ul class="hidden md:flex items-center space-x-6">
                    <li><a href="/#ai-solusi" class="text-primary hover:text-accent">AI Solusi</a></li>
                    <li><a href="/services.php" class="text-primary hover:text-accent">Layanan</a></li>
                    <li><a href="/#portofolio" class="text-primary hover:text-accent">Portofolio</a></li>
                    <li><a href="/#kontak" class="text-primary hover:text-accent">Kontak</a></li>

                    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                        <?php if ($_SESSION["role"] === 'admin'): ?>
                            <li><a href="/admin/index.php" class="px-4 py-2 bg-card-bg text-accent font-semibold rounded-md border border-accent">Admin Dashboard</a></li>
                        <?php else: ?>
                            <li><a href="/client/index.php" class="px-4 py-2 bg-card-bg text-accent font-semibold rounded-md border border-accent">Client Dashboard</a></li>
                        <?php endif; ?>
                        <li><a href="/logout.php" class="px-4 py-2 bg-red-500/80 text-white font-semibold rounded-md">Logout</a></li>
                    <?php else: ?>
                        <li><a href="/kontak.php" class="px-4 py-2 bg-accent text-background font-semibold rounded-md hover:bg-yellow-400">Hubungi Kami</a></li>
                        <li><a href="/login.php" class="px-4 py-2 bg-card-bg text-accent font-semibold rounded-md border border-accent hover:bg-accent hover:text-background">Login</a></li>
                    <?php endif; ?>
                </ul>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-primary focus:outline-none z-[110]">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-4 6h4"></path></svg>
                    </button>
                </div>
            </nav>
        </header>

        <!-- Mobile Menu (can be included in footer or here) -->
        <main class="pt-16"> <!-- Add padding-top to body content to avoid being obscured by fixed header -->
