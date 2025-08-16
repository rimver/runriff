<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../helpers.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R/I/M - Inovasi Teknologi Terintegrasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-background">
    <div class="font-sans text-primary antialiased">
      <?php require_once 'partials/header.php'; ?>
      <main>
        <section class="relative h-screen flex items-center justify-center text-center overflow-hidden pt-16">
          <div id="particles-js" class="absolute top-0 left-0 w-full h-full z-0"></div>
          <div class="absolute top-0 left-0 w-full h-full bg-background/50 z-10"></div>
          <div class="relative z-20 container mx-auto px-6 flex flex-col items-center">
            <h1 class="text-4xl md:text-6xl font-display font-bold text-primary mb-4 max-w-4xl shimmer-effect">
                <?php echo getContent('hero_title', 'Bisnis Anda Punya Potensi. Kami Punya Teknologinya.'); ?>
            </h1>
            <p class="text-lg md:text-xl text-secondary max-w-3xl mb-8">
                <?php echo getContent('hero_subtitle', 'Lupakan kerumitan teknis. Kami adalah mitra teknologi satu pintu yang membereskan semuanya—dari instalasi fisik hingga inovasi digital—agar Anda bisa fokus pada hal terpenting: mengembangkan bisnis.'); ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
              <a href="#ai-solusi" class="bg-accent text-background font-bold py-3 px-8 rounded-md hover:bg-yellow-400 transition-all duration-300 text-lg transform hover:scale-105">
                Coba AI Strategist Kami
              </a>
              <a href="/login.php" class="bg-card-bg text-accent font-bold py-3 px-8 rounded-md border border-accent hover:bg-accent hover:text-background transition-all duration-300 text-lg transform hover:scale-105">
                Client Portal
              </a>
            </div>
          </div>
        </section>

        <section id="ai-solusi" class="py-20 bg-card-bg/30">
          <div class="container mx-auto px-6">
            <div class="text-center mb-16">
              <h2 class="text-4xl md:text-5xl font-display font-bold mb-4 text-primary shimmer-effect">AI Business Toolkit</h2>
              <p class="text-xl text-secondary max-w-4xl mx-auto mb-8">Dapatkan jawaban, ide, dan strategi dalam hitungan detik. Alat AI gratis ini kami rancang untuk memecahkan masalah bisnis nyata.</p>
            </div>
            <div class="bg-card-bg/50 p-6 md:p-10 rounded-lg border border-border-color min-h-[500px] transition-all duration-300 mb-12">
              <div class="flex flex-wrap justify-center border-b border-border-color mb-8">
                <button class="ai-tab-button active-tab py-4 px-6 block hover:text-accent focus:outline-none text-accent border-b-2 font-medium border-accent transition-colors" data-tab="solution-strategist">Business Solution Strategist</button>
                <button class="ai-tab-button py-4 px-6 block hover:text-accent focus:outline-none text-secondary transition-colors" data-tab="marketing-strategist">Marketing Strategist</button>
                <button class="ai-tab-button py-4 px-6 block hover:text-accent focus:outline-none text-secondary transition-colors" data-tab="product-description">Product Description</button>
                <button class="ai-tab-button py-4 px-6 block hover:text-accent focus:outline-none text-secondary transition-colors" data-tab="it-architect">IT Architect Estimator</button>
              </div>
              <div id="ai-toolkit-content">
                <div id="solution-strategist" class="ai-tab-content"><div class="text-center"><h3 class="text-2xl font-display font-bold mb-4 text-primary">Business Solution Strategist</h3><p class="text-secondary mb-6">Dapatkan solusi bisnis berbasis AI untuk pertanyaan Anda</p><div class="max-w-2xl mx-auto"><form class="ai-form space-y-4" data-persona="business_solution"><div><label for="business-question" class="sr-only">Apa pertanyaan bisnis Anda?</label><textarea rows="4" placeholder="Contoh: Bagaimana cara meningkatkan efisiensi operasional di gudang kami?" class="w-full bg-background border border-border-color rounded-md p-3 text-primary focus:ring-2 focus:ring-accent resize-none"></textarea></div><button type="submit" class="ai-submit-btn bg-accent text-background font-bold py-3 px-6 rounded-md hover:bg-yellow-400 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">Dapatkan Solusi AI</button></form><div class="ai-result hidden mt-6 p-6 bg-background/50 rounded-lg border border-border-color"><h4 class="font-bold text-primary mb-3">AI Response:</h4><div class="ai-response text-secondary leading-relaxed"></div></div></div></div></div>
                <div id="marketing-strategist" class="ai-tab-content hidden"><div class="text-center"><h3 class="text-2xl font-display font-bold mb-4 text-primary">AI Marketing Strategist</h3><p class="text-secondary mb-6">Dapatkan ide kampanye pemasaran yang inovatif.</p><div class="max-w-2xl mx-auto"><form class="ai-form space-y-4" data-persona="marketing"><div><label for="marketing-prompt" class="sr-only">Jelaskan produk dan target audiens Anda</label><textarea rows="4" placeholder="Contoh: Produk kopi organik untuk kalangan muda profesional di perkotaan." class="w-full bg-background border border-border-color rounded-md p-3 text-primary focus:ring-2 focus:ring-accent resize-none"></textarea></div><button type="submit" class="ai-submit-btn bg-accent text-background font-bold py-3 px-6 rounded-md hover:bg-yellow-400 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">Dapatkan Ide Pemasaran</button></form><div class="ai-result hidden mt-6 p-6 bg-background/50 rounded-lg border border-border-color"><h4 class="font-bold text-primary mb-3">AI Response:</h4><div class="ai-response text-secondary leading-relaxed"></div></div></div></div></div>
                <div id="product-description" class="ai-tab-content hidden"><div class="text-center"><h3 class="text-2xl font-display font-bold mb-4 text-primary">AI Product Description Generator</h3><p class="text-secondary mb-6">Buat deskripsi produk yang menjual dalam sekejap.</p><div class="max-w-2xl mx-auto"><form class="ai-form space-y-4" data-persona="product_description"><div><label for="product-details" class="sr-only">Deskripsikan produk Anda</label><textarea rows="4" placeholder="Contoh: Laptop gaming dengan RTX 4060, RAM 16GB, SSD 512GB, layar 15.6 inch 144Hz." class="w-full bg-background border border-border-color rounded-md p-3 text-primary focus:ring-2 focus:ring-accent resize-none"></textarea></div><button type="submit" class="ai-submit-btn bg-accent text-background font-bold py-3 px-6 rounded-md hover:bg-yellow-400 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">Generate Deskripsi</button></form><div class="ai-result hidden mt-6 p-6 bg-background/50 rounded-lg border border-border-color"><h4 class="font-bold text-primary mb-3">AI Response:</h4><div class="ai-response text-secondary leading-relaxed"></div></div></div></div></div>
                <div id="it-architect" class="ai-tab-content hidden"><div class="text-center"><h3 class="text-2xl font-display font-bold mb-4 text-primary">IT Architect & Cost Estimator</h3><p class="text-secondary mb-6">Estimasi biaya dan arsitektur IT untuk proyek Anda.</p><div class="max-w-2xl mx-auto"><form class="ai-form space-y-4" data-persona="it_architect"><div><label for="project-details" class="sr-only">Deskripsikan proyek IT Anda</label><textarea rows="4" placeholder="Contoh: Website e-commerce untuk 100 produk, sistem pembayaran, dan manajemen inventory." class="w-full bg-background border border-border-color rounded-md p-3 text-primary focus:ring-2 focus:ring-accent resize-none"></textarea></div><button type="submit" class="ai-submit-btn bg-accent text-background font-bold py-3 px-6 rounded-md hover:bg-yellow-400 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">Estimasi Proyek</button></form><div class="ai-result hidden mt-6 p-6 bg-background/50 rounded-lg border border-border-color"><h4 class="font-bold text-primary mb-3">AI Response:</h4><div class="ai-response text-secondary leading-relaxed"></div></div></div></div></div>
              </div>
            </div>
          </div>
        </section>
      </main>
      <?php require_once 'partials/footer.php'; ?>
    </div>
</body>
</html>
