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

        <!-- Other sections from the user's HTML would go here -->

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
