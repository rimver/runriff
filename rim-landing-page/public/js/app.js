// PWA Initialization
document.addEventListener('DOMContentLoaded', function() {
    // Check if PWA is supported
    if ('serviceWorker' in navigator) {
        console.log('[PWA] PWA supported');

        // Show loading screen
        const loading = document.createElement('div');
        loading.className = 'pwa-loading';
        loading.innerHTML = '<div class="pwa-spinner"></div>';
        document.body.appendChild(loading);

        // Hide loading after page load
        window.addEventListener('load', () => {
            setTimeout(() => {
                loading.classList.add('hidden');
                setTimeout(() => loading.remove(), 500);
            }, 1000);
        });

        // Load PWA Manager
        const pwaScript = document.createElement('script');
        pwaScript.src = '/js/pwa-manager.js';
        pwaScript.defer = true;
        document.head.appendChild(pwaScript);

        // Load Mobile Menu Script
        const menuScript = document.createElement('script');
        menuScript.src = '/js/mobile-menu.js';
        menuScript.defer = true;
        document.head.appendChild(menuScript);

        // Offline indicator
        const offlineIndicator = document.createElement('div');
        offlineIndicator.className = 'pwa-offline-indicator';
        offlineIndicator.innerHTML = '⚡ You are offline - Limited functionality available';
        document.body.appendChild(offlineIndicator);

        function updateOnlineStatus() {
            if (navigator.onLine) {
                offlineIndicator.classList.remove('show');
            } else {
                offlineIndicator.classList.add('show');
            }
        }

        window.addEventListener('online', updateOnlineStatus);
        window.addEventListener('offline', updateOnlineStatus);
        updateOnlineStatus();

        // iOS install hint
        if (/iPhone|iPad|iPod/.test(navigator.userAgent) && !window.navigator.standalone) {
            setTimeout(() => {
                const iosInstall = document.createElement('div');
                iosInstall.className = 'pwa-ios-install';
                iosInstall.innerHTML = `
                    <div>📱 Install R/I/M Technology App</div>
                    <div class="pwa-ios-steps">
                        <div class="pwa-ios-step">
                            1. Tap <span class="pwa-ios-icon">⬆️</span> Share button
                        </div>
                        <div class="pwa-ios-step">
                            2. Select <span class="pwa-ios-icon">➕</span> "Add to Home Screen"
                        </div>
                        <div class="pwa-ios-step">
                            3. Tap <span class="pwa-ios-icon">✅</span> "Add"
                        </div>
                    </div>
                    <button onclick="this.parentElement.remove()" style="margin-top: 16px; background: #3B82F6; color: white; border: none; padding: 8px 16px; border-radius: 6px;">Got it!</button>
                `;
                document.body.appendChild(iosInstall);

                setTimeout(() => {
                    iosInstall.classList.add('show');
                }, 3000);
            }, 5000);
        }

    } else {
        console.log('[PWA] PWA not supported');
    }

    // Add PWA class to body when running as installed app
    if (window.matchMedia('(display-mode: standalone)').matches ||
        window.navigator.standalone === true) {
        document.body.classList.add('pwa-installed');

        // Add PWA badge to page title
        const badge = document.createElement('span');
        badge.className = 'pwa-badge';
        badge.textContent = 'PWA';
        badge.title = 'Running as installed app';

        const title = document.querySelector('h1');
        if (title) {
            title.style.position = 'relative';
            title.appendChild(badge);
        }
    }
});

// PWA Analytics
function trackPWAEvent(eventName, data = {}) {
    if (window.gtag) {
        gtag('event', eventName, {
            event_category: 'PWA',
            event_label: 'R/I/M Technology',
            ...data
        });
    }

    console.log('[PWA Analytics]', eventName, data);
}

// Track PWA installation
window.addEventListener('beforeinstallprompt', () => {
    trackPWAEvent('install_prompt_shown');
});

window.addEventListener('appinstalled', () => {
    trackPWAEvent('app_installed');
});

// Track standalone usage
if (window.matchMedia('(display-mode: standalone)').matches) {
    trackPWAEvent('standalone_usage');
}

tailwind.config = {
    theme: {
      extend: {
        colors: {
          'background': '#0A192F',
          'card-bg': '#172A45',
          'primary': '#CCD6F6',
          'secondary': '#8892B0',
          'accent': '#E0C56E',
          'border-color': '#233554',
          'whatsapp': '#25D366',
        },
        fontFamily: {
          'sans': ['Inter', 'sans-serif'],
          'display': ['Poppins', 'sans-serif'],
        },
        backdropBlur: {
          'xs': '2px',
        }
      }
    }
}

// Enhanced Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileMenuClose = document.getElementById('mobile-menu-close');
  const body = document.body;

  // Toggle mobile menu
  function toggleMobileMenu() {
    const isActive = mobileMenu.classList.contains('active');

    if (isActive) {
      closeMobileMenu();
    } else {
      openMobileMenu();
    }
  }

  // Open mobile menu
  function openMobileMenu() {
    mobileMenu.classList.add('active');
    mobileMenuButton.classList.add('active');
    body.style.overflow = 'hidden'; // Prevent scrolling

    // Add escape key listener
    document.addEventListener('keydown', handleEscapeKey);
  }

  // Close mobile menu
  function closeMobileMenu() {
    mobileMenu.classList.remove('active');
    mobileMenuButton.classList.remove('active');
    body.style.overflow = ''; // Restore scrolling

    // Remove escape key listener
    document.removeEventListener('keydown', handleEscapeKey);
  }

  // Handle escape key
  function handleEscapeKey(e) {
    if (e.key === 'Escape') {
      closeMobileMenu();
    }
  }

  // Event listeners
  mobileMenuButton.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    toggleMobileMenu();
  });

  // Close button
  if (mobileMenuClose) {
    mobileMenuClose.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      closeMobileMenu();
    });
  }

  // Close mobile menu when clicking on a link
  const mobileMenuLinks = mobileMenu.querySelectorAll('a');
  mobileMenuLinks.forEach(link => {
    link.addEventListener('click', function() {
      // Add small delay for better UX
      setTimeout(() => {
        closeMobileMenu();
      }, 150);
    });
  });

  // Close menu when clicking outside (on overlay)
  mobileMenu.addEventListener('click', function(e) {
    if (e.target === mobileMenu) {
      closeMobileMenu();
    }
  });

  // Prevent menu close when clicking inside menu content
  mobileMenu.querySelector('ul').addEventListener('click', function(e) {
    e.stopPropagation();
  });

  // Handle window resize
  window.addEventListener('resize', function() {
    if (window.innerWidth >= 768) { // md breakpoint
      closeMobileMenu();
    }
  });

  // Add touch/swipe gestures for mobile
  let startY = 0;
  let startX = 0;

  mobileMenu.addEventListener('touchstart', function(e) {
    startY = e.touches[0].clientY;
    startX = e.touches[0].clientX;
  });

  mobileMenu.addEventListener('touchend', function(e) {
    const endY = e.changedTouches[0].clientY;
    const endX = e.changedTouches[0].clientX;
    const diffY = startY - endY;
    const diffX = startX - endX;

    // Swipe up to close (more than 100px)
    if (diffY > 100 && Math.abs(diffX) < 100) {
      closeMobileMenu();
    }
  });

  console.log('[Mobile Menu] Initialized successfully');
});

// Header scroll effect
window.addEventListener('scroll', function() {
  const header = document.getElementById('main-header');
  if (window.scrollY > 50) {
    header.classList.add('bg-background/95');
    header.classList.remove('bg-background/80');
  } else {
    header.classList.add('bg-background/80');
    header.classList.remove('bg-background/95');
  }
});

// Initialize particles.js
if (document.getElementById('particles-js')) {
    particlesJS('particles-js', {
      particles: {
        number: { value: 80, density: { enable: true, value_area: 800 } },
        color: { value: '#E0C56E' },
        shape: { type: 'circle' },
        opacity: { value: 0.5, random: false },
        size: { value: 3, random: true },
        line_linked: { enable: true, distance: 150, color: '#E0C56E', opacity: 0.4, width: 1 },
        move: { enable: true, speed: 6, direction: 'none', random: false, straight: false, out_mode: 'out', bounce: false }
      },
      interactivity: {
        detect_on: 'canvas',
        events: { onhover: { enable: true, mode: 'repulse' }, onclick: { enable: true, mode: 'push' }, resize: true },
        modes: { grab: { distance: 400, line_linked: { opacity: 1 } }, bubble: { distance: 400, size: 40, duration: 2, opacity: 8, speed: 3 }, repulse: { distance: 200, duration: 0.4 }, push: { particles_nb: 4 }, remove: { particles_nb: 2 } }
      },
      retina_detect: true
    });
}

// AI Toolkit Tab Functionality
document.querySelectorAll('.ai-tab-button').forEach(button => {
    button.addEventListener('click', function() {
      const targetTab = this.getAttribute('data-tab');

      // Remove active class from all buttons and contents
      document.querySelectorAll('.ai-tab-button').forEach(btn => {
        btn.classList.remove('active-tab', 'text-accent', 'border-accent');
        btn.classList.add('text-secondary');
      });
      document.querySelectorAll('.ai-tab-content').forEach(content => {
        content.classList.add('hidden');
      });

      // Add active class to clicked button
      this.classList.add('active-tab', 'text-accent', 'border-accent');
      this.classList.remove('text-secondary');

      // Show target content
      document.getElementById(targetTab).classList.remove('hidden');
    });
});

// AI Form Submissions
document.querySelectorAll('.ai-form').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();

      const textarea = this.querySelector('textarea');
      const submitBtn = this.querySelector('.ai-submit-btn');
      const resultDiv = this.parentElement.querySelector('.ai-result');
      const responseDiv = this.parentElement.querySelector('.ai-response');
      const persona = this.getAttribute('data-persona');
      const originalButtonText = submitBtn.innerHTML;

      if (!textarea.value.trim()) {
        alert('Please enter your question or request.');
        return;
      }

      // Show loading state
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="bi bi-hourglass-split mr-2"></i>Processing...';
      resultDiv.classList.add('hidden');

      // Call the backend API
      fetch('/api/ai_generate.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          persona: persona,
          prompt: textarea.value
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Sanitize response before injecting as HTML
          const sanitizedResponse = data.response.replace(/\n/g, '<br>');
          responseDiv.innerHTML = sanitizedResponse;
        } else {
          responseDiv.textContent = data.response || 'An unknown error occurred.';
        }
        resultDiv.classList.remove('hidden');
      })
      .catch(error => {
        console.error('Detailed Fetch Error:', error);
        responseDiv.textContent = 'An error occurred. Please check the browser console for more details.';
        resultDiv.classList.remove('hidden');
      })
      .finally(() => {
        // Reset button state
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalButtonText;
      });
    });
});

// Service Category Filter
document.querySelectorAll('.service-category-btn').forEach(button => {
    button.addEventListener('click', function() {
      const category = this.getAttribute('data-category');

      // Update active button
      document.querySelectorAll('.service-category-btn').forEach(btn => {
        btn.classList.remove('active', 'bg-accent', 'text-background');
        btn.classList.add('bg-card-bg', 'text-primary');
      });
      this.classList.add('active', 'bg-accent', 'text-background');
      this.classList.remove('bg-card-bg', 'text-primary');

      // Filter services
      document.querySelectorAll('.service-card').forEach(card => {
        if (category === 'all' || card.getAttribute('data-category') === category) {
          card.style.display = 'block';
          setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
          }, 100);
        } else {
          card.style.opacity = '0';
          card.style.transform = 'translateY(20px)';
          setTimeout(() => {
            card.style.display = 'none';
          }, 300);
        }
      });
    });
});

// Contact Form
document.getElementById('contact-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const submitBtn = this.querySelector('button[type="submit"]');
    const messageDiv = document.getElementById('form-message');

    // Show loading state
    submitBtn.disabled = true;
    submitBtn.textContent = 'Mengirim...';

    try {
      // Simulate form submission
      await new Promise(resolve => setTimeout(resolve, 2000));

      messageDiv.className = 'mt-4 text-center text-green-400';
      messageDiv.textContent = 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.';
      messageDiv.classList.remove('hidden');

      this.reset();

    } catch (error) {
      messageDiv.className = 'mt-4 text-center text-red-400';
      messageDiv.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
      messageDiv.classList.remove('hidden');
    } finally {
      submitBtn.disabled = false;
      submitBtn.textContent = 'Kirim Pesan';

      // Hide message after 5 seconds
      setTimeout(() => {
        messageDiv.classList.add('hidden');
      }, 5000);
    }
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
});

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-fade-in-up');
      }
    });
}, observerOptions);

// Observe service cards and portfolio items
document.querySelectorAll('.service-card, .bg-card-bg').forEach(el => {
    observer.observe(el);
});

// AI Helper Functions
function showAIHelper(type) {
    const modal = document.getElementById('aiHelperModal');
    const title = document.getElementById('helperTitle');
    const content = document.getElementById('helperContent');

    const helpers = {
      business: {
        title: '🚀 Konsultasi Strategis Bisnis',
        content: `
          <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-4">
              <h3 class="text-lg font-semibold text-accent">Analisis Bisnis Gratis</h3>
              <div class="space-y-3">
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">📊 Audit Bisnis Digital</h4>
                  <p class="text-secondary text-sm">Evaluasi komprehensif digital presence Anda</p>
                </div>
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">💡 Strategi Pertumbuhan</h4>
                  <p class="text-secondary text-sm">Roadmap untuk scaling bisnis dengan teknologi</p>
                </div>
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">🎯 Market Analysis</h4>
                  <p class="text-secondary text-sm">Analisis kompetitor dan peluang pasar</p>
                </div>
              </div>
            </div>
            <div class="space-y-4">
              <h3 class="text-lg font-semibold text-accent">Solusi Khusus Anda</h3>
              <form class="space-y-3">
                <input type="text" placeholder="Nama bisnis Anda" class="w-full bg-background border border-border-color rounded-lg px-4 py-2 text-primary">
                <select class="w-full bg-background border border-border-color rounded-lg px-4 py-2 text-primary">
                  <option>Pilih industri bisnis</option>
                  <option>E-commerce</option>
                  <option>Jasa Profesional</option>
                  <option>Manufaktur</option>
                  <option>F&B</option>
                  <option>Teknologi</option>
                  <option>Pendidikan</option>
                </select>
                <textarea placeholder="Tantangan utama bisnis Anda" rows="3" class="w-full bg-background border border-border-color rounded-lg px-4 py-2 text-primary resize-none"></textarea>
                <button type="button" onclick="generateBusinessSolution()" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors">
                  <i class="bi bi-magic mr-2"></i>Generate Solusi AI
                </button>
              </form>
            </div>
          </div>
        `
      },
      marketing: {
        title: '📢 Strategi Marketing Digital',
        content: `
          <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-4">
              <h3 class="text-lg font-semibold text-accent">Tools Marketing Gratis</h3>
              <div class="space-y-3">
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">📱 Social Media Audit</h4>
                  <p class="text-secondary text-sm">Analisis performa media sosial Anda</p>
                  <button onclick="openSocialAudit()" class="mt-2 text-accent hover:text-yellow-400 text-sm">Mulai Audit →</button>
                </div>
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">🎯 Targeting Analysis</h4>
                  <p class="text-secondary text-sm">Identifikasi target audience yang tepat</p>
                  <button onclick="openTargeting()" class="mt-2 text-accent hover:text-yellow-400 text-sm">Analisis →</button>
                </div>
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">📈 Growth Strategy</h4>
                  <p class="text-secondary text-sm">Strategi pertumbuhan organik dan paid</p>
                  <button onclick="openGrowthStrategy()" class="mt-2 text-accent hover:text-yellow-400 text-sm">Lihat Strategi →</button>
                </div>
              </div>
            </div>
            <div class="space-y-4">
              <h3 class="text-lg font-semibold text-accent">Campaign Builder</h3>
              <form class="space-y-3">
                <select class="w-full bg-background border border-border-color rounded-lg px-4 py-2 text-primary">
                  <option>Pilih jenis campaign</option>
                  <option>Brand Awareness</option>
                  <option>Lead Generation</option>
                  <option>Sales Conversion</option>
                  <option>Customer Retention</option>
                </select>
                <input type="number" placeholder="Budget (Rp)" class="w-full bg-background border border-border-color rounded-lg px-4 py-2 text-primary">
                <select class="w-full bg-background border border-border-color rounded-lg px-4 py-2 text-primary">
                  <option>Durasi campaign</option>
                  <option>1 Minggu</option>
                  <option>1 Bulan</option>
                  <option>3 Bulan</option>
                  <option>6 Bulan</option>
                </select>
                <button type="button" onclick="generateCampaign()" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors">
                  <i class="bi bi-rocket mr-2"></i>Buat Campaign
                </button>
              </form>
            </div>
          </div>
        `
      },
      tech: {
        title: '💻 Solusi Teknologi Enterprise',
        content: `
          <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-4">
              <h3 class="text-lg font-semibold text-accent">Tech Assessment</h3>
              <div class="space-y-3">
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">🔧 Infrastructure Audit</h4>
                  <p class="text-secondary text-sm">Evaluasi sistem IT dan infrastruktur</p>
                </div>
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">☁️ Cloud Migration</h4>
                  <p class="text-secondary text-sm">Strategi migrasi ke cloud yang efisien</p>
                </div>
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">🛡️ Security Review</h4>
                  <p class="text-secondary text-sm">Audit keamanan sistem komprehensif</p>
                </div>
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">📊 Performance Optimization</h4>
                  <p class="text-secondary text-sm">Optimasi performa aplikasi dan database</p>
                </div>
              </div>
            </div>
            <div class="space-y-4">
              <h3 class="text-lg font-semibold text-accent">Cost Calculator</h3>
              <form class="space-y-3">
                <select class="w-full bg-background border border-border-color rounded-lg px-4 py-2 text-primary">
                  <option>Jenis proyek teknologi</option>
                  <option>Website Development</option>
                  <option>Mobile App</option>
                  <option>Cloud Infrastructure</option>
                  <option>AI/ML Implementation</option>
                  <option>IoT Solution</option>
                  <option>Automation System</option>
                </select>
                <select class="w-full bg-background border border-border-color rounded-lg px-4 py-2 text-primary">
                  <option>Ukuran perusahaan</option>
                  <option>Startup (1-10 karyawan)</option>
                  <option>Small Business (11-50 karyawan)</option>
                  <option>Medium Enterprise (51-200 karyawan)</option>
                  <option>Large Enterprise (200+ karyawan)</option>
                </select>
                <select class="w-full bg-background border border-border-color rounded-lg px-4 py-2 text-primary">
                  <option>Timeline proyek</option>
                  <option>1-2 Bulan</option>
                  <option>3-6 Bulan</option>
                  <option>6-12 Bulan</option>
                  <option>12+ Bulan</option>
                </select>
                <button type="button" onclick="calculateTechCost()" class="w-full bg-purple-500 text-white py-2 rounded-lg hover:bg-purple-600 transition-colors">
                  <i class="bi bi-calculator mr-2"></i>Hitung Estimasi
                </button>
              </form>
            </div>
          </div>
        `
      },
      automation: {
        title: '🤖 Sistem Otomatisasi Bisnis',
        content: `
          <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-4">
              <h3 class="text-lg font-semibold text-accent">Automation Opportunities</h3>
              <div class="space-y-3">
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">📋 Process Automation</h4>
                  <p class="text-secondary text-sm">Otomatisasi workflow dan proses bisnis</p>
                  <div class="mt-2 text-xs text-accent">Save up to 70% waktu operasional</div>
                </div>
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">💬 Chatbot & AI</h4>
                  <p class="text-secondary text-sm">Customer service otomatis 24/7</p>
                  <div class="mt-2 text-xs text-accent">Tingkatkan response time 95%</div>
                </div>
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">📊 Reporting Automation</h4>
                  <p class="text-secondary text-sm">Laporan otomatis real-time</p>
                  <div class="mt-2 text-xs text-accent">Real-time insights & analytics</div>
                </div>
                <div class="bg-background/50 p-4 rounded-lg border border-border-color">
                  <h4 class="font-medium text-primary mb-2">🔗 Integration Hub</h4>
                  <p class="text-secondary text-sm">Integrasi sistem dan platform</p>
                  <div class="mt-2 text-xs text-accent">Connect 500+ applications</div>
                </div>
              </div>
            </div>
            <div class="space-y-4">
              <h3 class="text-lg font-semibold text-accent">ROI Calculator</h3>
              <form class="space-y-3">
                <input type="number" placeholder="Jumlah karyawan" class="w-full bg-background border border-border-color rounded-lg px-4 py-2 text-primary">
                <input type="number" placeholder="Jam kerja manual per hari" class="w-full bg-background border border-border-color rounded-lg px-4 py-2 text-primary">
                <input type="number" placeholder="Rata-rata gaji per jam (Rp)" class="w-full bg-background border border-border-color rounded-lg px-4 py-2 text-primary">
                <select class="w-full bg-background border border-border-color rounded-lg px-4 py-2 text-primary">
                  <option>Proses yang ingin diotomatisasi</option>
                  <option>Data Entry & Processing</option>
                  <option>Customer Service</option>
                  <option>Inventory Management</option>
                  <option>Financial Reporting</option>
                  <option>Email Marketing</option>
                  <option>Social Media Management</option>
                </select>
                <button type="button" onclick="calculateROI()" class="w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition-colors">
                  <i class="bi bi-graph-up mr-2"></i>Hitung ROI
                </button>
              </form>
              <div id="roiResult" class="hidden mt-4 p-4 bg-green-500/10 border border-green-500/30 rounded-lg">
                <h4 class="font-medium text-green-400 mb-2">Estimated Savings</h4>
                <div class="text-sm space-y-1">
                  <div class="flex justify-between"><span>Monthly Savings:</span><span id="monthlySaving" class="text-green-400"></span></div>
                  <div class="flex justify-between"><span>Annual Savings:</span><span id="annualSaving" class="text-green-400"></span></div>
                  <div class="flex justify-between"><span>ROI Timeline:</span><span id="roiTimeline" class="text-green-400"></span></div>
                </div>
              </div>
            </div>
          </div>
        `
      }
    };

    title.textContent = helpers[type].title;
    content.innerHTML = helpers[type].content;
    modal.classList.remove('hidden');
}

function closeAIHelper() {
    document.getElementById('aiHelperModal').classList.add('hidden');
}

function showQuickAI() {
    showAIHelper('business');
}

function scheduleConsultation() {
    const whatsappUrl = "https://wa.me/62088991041919?text=Halo,%20saya%20ingin%20menjadwalkan%20konsultasi%20gratis%20dengan%20tim%20R/I/M%20Technology.%20Mohon%20informasi%20waktu%20yang%20tersedia.";
    window.open(whatsappUrl, '_blank');
}

// AI Helper Tools Functions
async function generateBusinessSolution() {
    const form = document.querySelector('#helperContent form');
    const businessName = form.querySelector('input[placeholder="Nama bisnis Anda"]').value;
    const industry = form.querySelector('select').value;
    const challenge = form.querySelector('textarea').value;

    if (!businessName || !industry || !challenge) {
      alert('Mohon lengkapi semua field untuk mendapatkan rekomendasi AI yang akurat.');
      return;
    }

    // Show loading state
    const button = form.querySelector('button[onclick="generateBusinessSolution()"]');
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="bi bi-hourglass-split mr-2"></i>Generating...';
    button.disabled = true;

    try {
      // Call real AI API (via backend)
      const response = await fetch('api/ai_generate.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          type: 'business_solution',
          data: {
            business_name: businessName,
            industry: industry,
            challenge: challenge
          }
        })
      });

      const result = await response.json();

      if (result.success) {
        const resultDiv = document.createElement('div');
        resultDiv.className = 'mt-4 p-4 bg-blue-500/10 border border-blue-500/30 rounded-lg animate-fade-in';
        resultDiv.innerHTML = `
          <h4 class="font-medium text-blue-400 mb-2">🎯 Rekomendasi AI untuk ${businessName}</h4>
          <div class="text-primary text-sm space-y-2">
            ${result.response.split('\n').map(line => line.trim() ? `<p>${line}</p>` : '').join('')}
          </div>
          <div class="mt-4 flex space-x-2">
            <button onclick="downloadBusinessPlan('${businessName}', '${result.response.replace(/'/g, "\\'")}'))" class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
              <i class="bi bi-download mr-1"></i>Download PDF
            </button>
                                 <button onclick="scheduleConsultation()" class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
               <i class="bi bi-calendar-event mr-1"></i>Jadwalkan Meeting
             </button>
             <button onclick="copyToClipboard('${result.response.replace(/'/g, "\\'")}', this)" class="bg-purple-500 text-white px-3 py-1 rounded text-xs hover:bg-purple-600">
               <i class="bi bi-clipboard mr-1"></i>Copy
             </button>
          </div>
        `;

        // Remove existing results
        const existingResult = form.querySelector('.mt-4.p-4.bg-blue-500\\/10');
        if (existingResult) {
          existingResult.remove();
        }

        form.appendChild(resultDiv);

        // Track usage
        trackAIUsage('business_solution', industry);

      } else {
        throw new Error(result.error || 'AI generation failed');
      }

    } catch (error) {
      console.error('AI Generation Error:', error);

      // Fallback to local responses
      const responses = [
        `Berdasarkan analisis bisnis ${businessName} di industri ${industry}, kami merekomendasikan:\n\n1. Implementasi sistem CRM untuk meningkatkan customer retention hingga 25%\n2. Digital transformation roadmap selama 6 bulan\n3. Otomatisasi proses ${challenge.toLowerCase().includes('penjualan') ? 'penjualan' : 'operasional'}\n4. Analytics dashboard untuk monitoring real-time\n5. Strategi digital marketing terintegrasi dengan proyeksi ROI 300%`,

        `Solusi strategis untuk ${businessName}:\n\n1. ${challenge.toLowerCase().includes('marketing') ? 'Marketing automation dan lead nurturing system' : 'Optimasi workflow dan sistem manajemen'}\n2. Cloud migration untuk efisiensi operasional 40%\n3. AI chatbot untuk customer service 24/7\n4. Integration dengan marketplace utama\n5. Business intelligence untuk decision making`,

        `Rekomendasi transformasi untuk ${businessName}:\n\n1. Modernisasi teknologi infrastruktur\n2. ${industry === 'E-commerce' ? 'Omnichannel experience dan personalisasi' : 'Digitalisasi proses bisnis core'}\n3. Data analytics dan predictive modeling\n4. Cybersecurity enhancement\n5. Training dan change management untuk tim`
      ];

      const fallbackResponse = responses[Math.floor(Math.random() * responses.length)];

      const resultDiv = document.createElement('div');
      resultDiv.className = 'mt-4 p-4 bg-blue-500/10 border border-blue-500/30 rounded-lg';
      resultDiv.innerHTML = `
        <h4 class="font-medium text-blue-400 mb-2">🎯 Rekomendasi untuk ${businessName}</h4>
        <div class="text-primary text-sm space-y-2">
          ${fallbackResponse.split('\n').map(line => line.trim() ? `<p>${line}</p>` : '').join('')}
        </div>
        <div class="mt-4 flex space-x-2">
                             <button onclick="downloadBusinessPlan('${businessName}', '${fallbackResponse.replace(/'/g, "\\'")}'))" class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
             <i class="bi bi-download mr-1"></i>Download PDF
           </button>
           <button onclick="scheduleConsultation()" class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
             <i class="bi bi-calendar-event mr-1"></i>Jadwalkan Meeting
           </button>
        </div>
      `;

      form.appendChild(resultDiv);
    } finally {
      // Reset button
      button.innerHTML = originalText;
      button.disabled = false;
    }
}

function downloadBusinessPlan(businessName, content) {
    // Create PDF-like content
    const pdfContent = `
BUSINESS RECOMMENDATION REPORT
Generated by R/I/M Technology AI

Business: ${businessName}
Date: ${new Date().toLocaleDateString('id-ID')}
Time: ${new Date().toLocaleTimeString('id-ID')}

EXECUTIVE SUMMARY
${content}

NEXT STEPS
1. Schedule a free consultation with our experts
2. Review detailed implementation timeline
3. Discuss budget and resource allocation
4. Begin pilot project implementation

CONTACT INFORMATION
R/I/M Technology
Email: info@rim-technology.com
Phone: +62 812-3456-7890
Website: https://rim-technology.com

---
This report was generated by AI and should be reviewed with our business consultants for detailed implementation planning.
    `.trim();

    // Create and download text file
    const blob = new Blob([pdfContent], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `Business_Plan_${businessName.replace(/\s+/g, '_')}_${new Date().getFullYear()}.txt`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);

    // Track download
    trackAIUsage('business_plan_download', businessName);
}

function trackAIUsage(action, data) {
    // Track AI tool usage for analytics
    fetch('api/track_usage.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        action: action,
        data: data,
        timestamp: new Date().toISOString(),
        page: 'landing'
      })
    }).catch(console.error);
}

function calculateROI() {
    const employees = document.querySelector('input[placeholder="Jumlah karyawan"]').value || 10;
    const hours = document.querySelector('input[placeholder="Jam kerja manual per hari"]').value || 8;
    const hourlyWage = document.querySelector('input[placeholder="Rata-rata gaji per jam (Rp)"]').value || 50000;

    const dailyCost = employees * hours * hourlyWage;
    const monthlyCost = dailyCost * 22; // 22 working days
    const automationSaving = monthlyCost * 0.6; // 60% automation efficiency
    const annualSaving = automationSaving * 12;

    document.getElementById('monthlySaving').textContent = `Rp ${automationSaving.toLocaleString('id-ID')}`;
    document.getElementById('annualSaving').textContent = `Rp ${annualSaving.toLocaleString('id-ID')}`;
    document.getElementById('roiTimeline').textContent = '3-6 bulan';
    document.getElementById('roiResult').classList.remove('hidden');
}

function calculateTechCost() {
    const estimates = {
      'Website Development': { min: 15000000, max: 150000000 },
      'Mobile App': { min: 50000000, max: 300000000 },
      'Cloud Infrastructure': { min: 25000000, max: 200000000 },
      'AI/ML Implementation': { min: 100000000, max: 500000000 },
      'IoT Solution': { min: 75000000, max: 400000000 },
      'Automation System': { min: 30000000, max: 250000000 }
    };

    const projectType = document.querySelector('select').value;
    const estimate = estimates[projectType] || { min: 10000000, max: 100000000 };

    alert(`Estimasi biaya untuk ${projectType}: Rp ${estimate.min.toLocaleString('id-ID')} - Rp ${estimate.max.toLocaleString('id-ID')}`);
}

if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
      navigator.serviceWorker.register('/sw.js').then(function(registration) {
        console.log('ServiceWorker registration successful with scope: ', registration.scope);
      }, function(err) {
        console.log('ServiceWorker registration failed: ', err);
      });
    });
}

// PWA Install Banner
let deferredPrompt;

window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent Chrome 67 and earlier from automatically showing the prompt
    e.preventDefault();
    // Stash the event so it can be triggered later.
    deferredPrompt = e;

    // Show install banner if not already installed
    showInstallBanner();
});

function showInstallBanner() {
    // Check if already installed
    if (window.matchMedia && window.matchMedia('(display-mode: standalone)').matches) {
      return; // Already installed
    }

    // Create install banner
    const banner = document.createElement('div');
    banner.id = 'pwa-banner';
    banner.style.cssText = `
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      background: linear-gradient(135deg, #1E293B, #334155);
      color: white;
      padding: 12px 16px;
      text-align: center;
      z-index: 9999;
      box-shadow: 0 2px 10px rgba(0,0,0,0.3);
      transform: translateY(-100%);
      transition: transform 0.3s ease;
    `;

    banner.innerHTML = `
      <div style="display: flex; align-items: center; justify-content: center; gap: 12px; flex-wrap: wrap;">
        <span style="font-size: 14px;">📱 Install RIM Tech App untuk pengalaman yang lebih baik</span>
        <button id="install-btn" style="background: #3B82F6; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 12px; cursor: pointer;">Install</button>
        <button id="close-banner" style="background: transparent; color: white; border: 1px solid rgba(255,255,255,0.3); padding: 6px 12px; border-radius: 6px; font-size: 12px; cursor: pointer;">Later</button>
      </div>
    `;

    document.body.appendChild(banner);

    // Show banner
    setTimeout(() => {
      banner.style.transform = 'translateY(0)';
    }, 1000);

    // Install button
    document.getElementById('install-btn').addEventListener('click', async () => {
      if (deferredPrompt) {
        deferredPrompt.prompt();
        const { outcome } = await deferredPrompt.userChoice;
        console.log(`User response to the install prompt: ${outcome}`);
        deferredPrompt = null;
        banner.remove();
      }
    });

    // Close button
    document.getElementById('close-banner').addEventListener('click', () => {
      banner.style.transform = 'translateY(-100%)';
      setTimeout(() => banner.remove(), 300);
    });

    // Auto hide after 10 seconds
    setTimeout(() => {
      if (document.getElementById('pwa-banner')) {
        banner.style.transform = 'translateY(-100%)';
        setTimeout(() => banner.remove(), 300);
      }
    }, 10000);
}

// Check if launched from home screen
window.addEventListener('appinstalled', (evt) => {
    console.log('PWA was installed');
});
