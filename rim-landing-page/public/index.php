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

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- PWA and Apple Meta Tags from original file -->
    <link rel="manifest" href="https://rayainti.biz.id/manifest.json">
    <meta name="theme-color" content="#1E293B">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="RIM Tech">
    <link rel="apple-touch-icon" href="https://rayainti.biz.id/pwa-icons/icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://rayainti.biz.id/assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://rayainti.biz.id/assets/icons/favicon-16x16.png">
    <link rel="shortcut icon" href="https://rayainti.biz.id/assets/icons/favicon.ico">

    <!-- Fonts and Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-background">
    <div class="font-sans text-primary antialiased">
      <!-- Header -->
      <header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 backdrop-blur-md bg-background/95">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
          <div class="logo">
            <a href="#" class="text-2xl font-display font-bold text-accent shimmer-effect">R/I/M</a>
          </div>

          <!-- Desktop Menu -->
          <ul class="hidden md:flex items-center space-x-6">
            <li><a href="#ai-solusi" class="text-primary hover:text-accent transition-colors duration-300">AI Solusi</a></li>
            <li><a href="#layanan" class="text-primary hover:text-accent transition-colors duration-300">Layanan</a></li>
            <li><a href="#portofolio" class="text-primary hover:text-accent transition-colors duration-300">Portofolio</a></li>
            <li><a href="#kontak" class="text-primary hover:text-accent transition-colors duration-300">Kontak</a></li>
            <li><a href="#" class="px-4 py-2 bg-accent text-background font-semibold rounded-md hover:bg-yellow-400 transition-colors duration-300">
                Hubungi Kami
              </a></li>
            <li><a href="#" class="px-4 py-2 bg-card-bg text-accent font-semibold rounded-md border border-accent hover:bg-accent hover:text-background transition-colors duration-300">
              Login
            </a></li>
          </ul>

          <!-- Mobile Menu Button -->
          <div class="md:hidden">
            <button id="mobile-menu-button" class="text-primary focus:outline-none z-[110]">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-4 6h4"></path>
              </svg>
            </button>
          </div>
        </nav>
      </header>

      <!-- Mobile Menu -->
      <div id="mobile-menu" class="nav-mobile">
        <button id="mobile-menu-close" class="mobile-close-btn" aria-label="Close Menu">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
        <ul class="flex flex-col items-center space-y-6 text-xl md:text-2xl">
            <li><a href="#ai-solusi" class="text-primary hover:text-accent transition-colors duration-300">🤖 AI Solusi</a></li>
            <li><a href="#layanan" class="text-primary hover:text-accent transition-colors duration-300">🔧 Layanan</a></li>
            <li><a href="#portofolio" class="text-primary hover:text-accent transition-colors duration-300">💼 Portofolio</a></li>
            <li><a href="#kontak" class="text-primary hover:text-accent transition-colors duration-300">ℹ️ Kontak</a></li>
            <li><a href="#" class="mt-6 px-8 py-4 bg-accent text-background font-semibold rounded-lg hover:bg-yellow-400 transition-all duration-300 transform hover:scale-105">
              📞 Hubungi Kami
            </a></li>
            <li><a href="#" class="mt-3 px-8 py-4 bg-card-bg text-accent font-semibold rounded-lg border border-accent hover:bg-accent hover:text-background transition-all duration-300 transform hover:scale-105">
              🔐 Login
            </a></li>
        </ul>
      </div>
      <main>

        <!-- Hero Section -->
        <section class="relative h-screen flex items-center justify-center text-center overflow-hidden pt-16">
          <div id="particles-js" class="absolute top-0 left-0 w-full h-full z-0"></div>
          <div class="absolute top-0 left-0 w-full h-full bg-background/50 z-10"></div>
          <div class="relative z-20 container mx-auto px-6 flex flex-col items-center">
            <h1 class="text-4xl md:text-6xl font-display font-bold text-primary mb-4 max-w-4xl shimmer-effect">
              Bisnis Anda Punya Potensi. Kami Punya Teknologinya.
            </h1>
            <p class="text-lg md:text-xl text-secondary max-w-3xl mb-8">
              Lupakan kerumitan teknis. Kami adalah mitra teknologi satu pintu yang membereskan semuanya—dari instalasi fisik hingga inovasi digital—agar Anda bisa fokus pada hal terpenting: mengembangkan bisnis.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
              <a href="#ai-solusi" class="bg-accent text-background font-bold py-3 px-8 rounded-md hover:bg-yellow-400 transition-all duration-300 text-lg transform hover:scale-105">
                Coba AI Strategist Kami
              </a>
              <a href="#" class="bg-card-bg text-accent font-bold py-3 px-8 rounded-md border border-accent hover:bg-accent hover:text-background transition-all duration-300 text-lg transform hover:scale-105">
                Client Portal
              </a>
            </div>
          </div>
        </section>

        <!-- AI Toolkit Section -->
        <section id="ai-solusi" class="py-20 bg-card-bg/30">
          <div class="container mx-auto px-6">
            <div class="text-center mb-16">
              <h2 class="text-4xl md:text-5xl font-display font-bold mb-4 text-primary shimmer-effect">
                AI Business Toolkit
              </h2>
              <p class="text-xl text-secondary max-w-4xl mx-auto mb-8">
                Dapatkan jawaban, ide, dan strategi dalam hitungan detik. Alat AI gratis ini kami rancang untuk memecahkan masalah bisnis nyata.
              </p>
            </div>

            <div class="bg-card-bg/50 p-6 md:p-10 rounded-lg border border-border-color min-h-[500px] transition-all duration-300 mb-12">
              <!-- Tab Navigation -->
              <div class="flex flex-wrap justify-center border-b border-border-color mb-8">
                <button class="ai-tab-button active-tab py-4 px-6 block hover:text-accent focus:outline-none text-accent border-b-2 font-medium border-accent transition-colors" data-tab="solution-strategist">
                  Business Solution Strategist
                </button>
                <button class="ai-tab-button py-4 px-6 block hover:text-accent focus:outline-none text-secondary transition-colors" data-tab="marketing-strategist">
                  Marketing Strategist
                </button>
                <button class="ai-tab-button py-4 px-6 block hover:text-accent focus:outline-none text-secondary transition-colors" data-tab="product-description">
                  Product Description
                </button>
                <button class="ai-tab-button py-4 px-6 block hover:text-accent focus:outline-none text-secondary transition-colors" data-tab="it-architect">
                  IT Architect Estimator
                </button>
              </div>

              <!-- Tab Content -->
              <div id="ai-toolkit-content">
                <!-- Business Solution Strategist -->
                <div id="solution-strategist" class="ai-tab-content">
                  <div class="text-center">
                    <h3 class="text-2xl font-display font-bold mb-4 text-primary">Business Solution Strategist</h3>
                    <p class="text-secondary mb-6">Dapatkan solusi bisnis berbasis AI untuk pertanyaan Anda</p>
                    <div class="max-w-2xl mx-auto">
                      <form class="ai-form space-y-4" data-persona="business_solution">
                        <div>
                          <label for="business-question" class="sr-only">Apa pertanyaan bisnis Anda?</label>
                          <textarea rows="4" placeholder="Contoh: Bagaimana cara meningkatkan efisiensi operasional di gudang kami?" class="w-full bg-background border border-border-color rounded-md p-3 text-primary focus:ring-2 focus:ring-accent resize-none"></textarea>
                        </div>
                        <button type="submit" class="ai-submit-btn bg-accent text-background font-bold py-3 px-6 rounded-md hover:bg-yellow-400 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                          Dapatkan Solusi AI
                        </button>
                      </form>
                      <div class="ai-result hidden mt-6 p-6 bg-background/50 rounded-lg border border-border-color">
                        <h4 class="font-bold text-primary mb-3">AI Response:</h4>
                        <div class="ai-response text-secondary leading-relaxed"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Other tabs would go here -->

              </div>
            </div>
          </div>
        </section>

        <!-- Services Section -->
        <section id="layanan" class="py-20">
          <div class="container mx-auto px-6">
            <div class="text-center mb-16">
              <h2 class="text-3xl md:text-4xl font-display font-bold mb-4 text-primary shimmer-effect">Layanan Kami</h2>
              <p class="text-lg text-secondary max-w-3xl mx-auto">Dari instalasi infrastruktur hingga transformasi digital enterprise</p>
            </div>
          </div>
        </section>

        <!-- Portfolio Section -->
        <section id="portofolio" class="py-20 bg-card-bg/30">
          <div class="container mx-auto px-6">
            <div class="text-center mb-16">
              <h2 class="text-3xl md:text-4xl font-display font-bold mb-4 text-primary shimmer-effect">Portofolio Kami</h2>
              <p class="text-lg text-secondary max-w-3xl mx-auto">Kisah sukses transformasi digital klien kami</p>
            </div>
          </div>
        </section>

        <!-- Contact Section -->
        <section id="kontak" class="py-20">
          <div class="container mx-auto px-6">
            <div class="text-center mb-16">
              <h2 class="text-3xl md:text-4xl font-display font-bold mb-4 text-primary shimmer-effect">Siap Memulai Transformasi Digital Anda?</h2>
              <p class="text-lg text-secondary max-w-3xl mx-auto">Hubungi kami hari ini untuk konsultasi gratis dan temukan solusi teknologi yang tepat untuk bisnis Anda.</p>
            </div>
          </div>
        </section>

      </main>
      <!-- Footer -->
      <footer class="py-12 bg-card-bg/30 border-t border-border-color">
        <div class="container mx-auto px-6">
          <div class="text-center">
            <p class="text-secondary text-sm">© <script>document.write(new Date().getFullYear())</script> R/I/M Technology. All Rights Reserved.</p>
          </div>
        </div>
      </footer>
    </div>

    <!-- External JS Libraries -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <!-- Custom JS -->
    <script src="js/app.js"></script>
</body>
</html>
