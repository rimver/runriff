# Panduan Instalasi Aplikasi di cPanel

Dokumen ini menjelaskan langkah-langkah untuk menginstal aplikasi PHP ini di lingkungan hosting cPanel standar.

---

## Prasyarat

Sebelum memulai, pastikan Anda memiliki:
1.  Akses login ke akun cPanel Anda.
2.  Sebuah nama domain atau subdomain yang sudah diarahkan ke hosting Anda.
3.  File aplikasi yang sudah di-zip dan siap untuk diunggah.

---

## Catatan Penting: Ekstensi PHP

Aplikasi ini memerlukan ekstensi PHP `pdo_mysql` agar dapat terhubung ke database. Sebagian besar host cPanel modern sudah mengaktifkannya secara default.

**Cara Memeriksa:**
1.  Di cPanel, cari "Select PHP Version".
2.  Di halaman tersebut, pastikan `pdo_mysql` (atau terkadang hanya `mysqlnd`) ada dalam daftar dan dicentang.
3.  Jika tidak dicentang, centang kotaknya dan simpan perubahan.

Jika Anda mendapatkan error "could not find driver" atau "500 error" saat menjalankan `setup.php`, kemungkinan besar ekstensi ini tidak aktif.

---

## Langkah 1: Unggah File Aplikasi

1.  **Login ke cPanel:** Masuk ke akun cPanel Anda.
2.  **Buka File Manager:** Cari dan klik ikon "File Manager".
3.  **Navigasi ke Direktori Root:** Buka direktori `public_html` (atau direktori root domain/subdomain Anda jika berbeda).
4.  **Unggah File:**
    -   Klik tombol "Upload" di menu atas.
    -   Pilih file `.zip` dari aplikasi yang sudah Anda siapkan.
    -   Tunggu hingga proses unggah selesai.
5.  **Ekstrak File:**
    -   Kembali ke File Manager.
    -   Klik kanan pada file `.zip` yang baru saja diunggah.
    -   Pilih "Extract" dari menu.
    -   Konfirmasi lokasi ekstraksi ke direktori `public_html`. Ini akan membuat folder `rim-landing-page`.
6.  **(Opsional) Pindahkan File:** Jika Anda ingin aplikasi diakses langsung dari domain Anda (misal, `yourdomain.com` bukan `yourdomain.com/rim-landing-page/public`), pindahkan semua isi dari folder `rim-landing-page/public` ke direktori `public_html`.

---

## Langkah 2: Buat Database MySQL

Aplikasi ini memerlukan database untuk menyimpan data pengguna, layanan, dan pesanan.

1.  **Kembali ke Dashboard cPanel:** Dari halaman utama cPanel, cari bagian "Databases".
2.  **Buka MySQL® Database Wizard:** Klik ikon "MySQL® Database Wizard". Ini adalah cara termudah untuk membuat database dan pengguna.
3.  **Langkah 1 - Buat Database:**
    -   Masukkan nama untuk database Anda (misal, `rim_db`). cPanel akan menambahkan prefix, seperti `username_rim_db`.
    -   Catat **nama database lengkap** ini.
    -   Klik "Next Step".
4.  **Langkah 2 - Buat Pengguna Database:**
    -   Masukkan nama pengguna (misal, `rim_user`). cPanel juga akan menambahkan prefix.
    -   Gunakan "Password Generator" untuk membuat password yang kuat dan aman.
    -   **PENTING:** Salin dan simpan **nama pengguna** dan **password** di tempat yang aman.
    -   Klik "Create User".
5.  **Langkah 3 - Tambahkan Hak Akses Pengguna:**
    -   Pada halaman "Add user to the database", centang kotak "ALL PRIVILEGES".
    -   Klik "Next Step".
6.  **Selesai:** Halaman "Task Complete" akan muncul. Anda sekarang memiliki database, pengguna, dan hak akses yang diperlukan.

---

## Langkah 3: Konfigurasi Aplikasi

Sekarang, Anda perlu memberitahu aplikasi cara terhubung ke database yang baru saja Anda buat.

1.  **Buka File Manager:** Kembali ke File Manager di cPanel.
2.  **Cari File Konfigurasi:** Navigasi ke direktori tempat Anda mengekstrak file, dan temukan file `config.php`.
3.  **Edit File:**
    -   Klik kanan pada `config.php` dan pilih "Edit".
    -   Anda akan melihat beberapa baris `define(...)`.
    -   Ganti nilai placeholder dengan informasi database yang Anda catat di Langkah 2.
        -   `DB_NAME`: Nama database lengkap (misal, `username_rim_db`).
        -   `DB_USER`: Nama pengguna database lengkap (misal, `username_rim_user`).
        -   `DB_PASSWORD`: Password yang Anda buat.
        -   `DB_HOST`: Biasanya `localhost`. Biarkan seperti ini kecuali penyedia hosting Anda memberikan informasi yang berbeda.
4.  **Simpan Perubahan:** Klik tombol "Save Changes" di pojok kanan atas.

---

## Langkah 4: Jalankan Skrip Setup Database

Langkah terakhir adalah membuat tabel yang diperlukan di dalam database Anda.

1.  **Buka Browser:** Buka browser web Anda.
2.  **Akses Skrip Setup:** Kunjungi URL tempat Anda mengunggah skrip `setup.php`.
    -   Contoh: `http://yourdomain.com/rim-landing-page/public/setup.php`
3.  **Jalankan Skrip:** Anda akan melihat pesan yang mengonfirmasi bahwa setiap tabel telah berhasil dibuat (atau sudah ada). Jika Anda melihat pesan error, pastikan ekstensi `pdo_mysql` aktif (lihat Catatan Penting di atas).
4.  **PENTING - Hapus Skrip Setup:** Setelah setup berhasil, sangat penting untuk **menghapus file `setup.php`** dari server Anda untuk alasan keamanan.
    -   Kembali ke File Manager, klik kanan pada `setup.php`, dan pilih "Delete".

---

## Instalasi Selesai!

Aplikasi Anda sekarang sudah terinstal dan siap digunakan. Anda bisa mengunjungi domain Anda untuk melihat halaman utama.
