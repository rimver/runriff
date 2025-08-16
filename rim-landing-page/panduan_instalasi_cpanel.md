# Panduan Instalasi Aplikasi di cPanel (Metode Aman)

Dokumen ini menjelaskan metode yang direkomendasikan dan paling aman untuk menginstal aplikasi PHP ini di lingkungan hosting cPanel.

---

## Prasyarat

-   Akses login ke akun cPanel Anda.
-   Sebuah nama domain atau subdomain yang sudah diarahkan ke hosting Anda.
-   File aplikasi (`rim-landing-page.zip`) yang siap untuk diunggah.

---

## Catatan Penting: Ekstensi PHP

Aplikasi ini memerlukan ekstensi PHP `pdo_mysql` untuk terhubung ke database.
**Cara Memeriksa:**
1.  Di cPanel, cari dan buka **"Select PHP Version"**.
2.  Pastikan `pdo_mysql` (atau `mysqlnd`) ada dalam daftar dan dicentang.
3.  Jika tidak, centang kotaknya dan simpan perubahan.
*Kegagalan pada langkah ini adalah penyebab umum error "500" atau "could not find driver".*

---

## Langkah 1: Unggah dan Ekstrak File Aplikasi

Metode ini akan menjaga file-file sensitif (seperti `config.php`) di luar direktori web publik, yang jauh lebih aman.

1.  **Login ke cPanel** dan buka **File Manager**.
2.  Navigasi ke direktori `home` Anda (direktori paling atas, di atas `public_html`).
3.  Klik **"Upload"** dan unggah file `rim-landing-page.zip` Anda.
4.  Setelah selesai, kembali ke File Manager, klik kanan pada file `.zip` dan pilih **"Extract"**. Ini akan membuat folder `rim-landing-page` di direktori `home` Anda.

---

## Langkah 2: Arahkan Domain ke Folder `public`

Ini adalah langkah paling penting untuk keamanan dan agar URL Anda bersih (`yourdomain.com` bukan `yourdomain.com/public`).

1.  **Kembali ke Dashboard cPanel** dan cari bagian "Domains".
2.  Klik pada **"Domains"**.
3.  Temukan domain utama atau subdomain yang ingin Anda gunakan. Di sebelah kanan, klik **"Manage"**.
4.  Di bawah "New Document Root", ubah path direktori. Pathnya harus menunjuk ke folder `public` yang baru saja Anda ekstrak.
    -   Contoh Path: `public_html/rim-landing-page/public` (jika Anda mengekstrak di dalam public_html) atau `rim-landing-page/public` (jika Anda mengekstrak di home). CPanel akan memvalidasi path ini.
    -   **PENTING:** Pastikan path ini benar. Seharusnya menunjuk ke direktori yang berisi file `index.php`.
5.  Klik **"Update"**. cPanel akan mengonfigurasi ulang Apache untuk melayani situs Anda dari direktori yang aman ini.

---

## Langkah 3: Buat Database MySQL

Langkah ini sama seperti sebelumnya, membuat database untuk aplikasi.

1.  Di cPanel, buka **"MySQL® Database Wizard"**.
2.  **Buat Database:** Beri nama (misal, `rimdb`) dan catat nama lengkapnya (misal, `cpaneluser_rimdb`).
3.  **Buat Pengguna:** Buat nama pengguna (misal, `rimuser`) dan password yang kuat. Catat detail ini.
4.  **Berikan Hak Akses:** Tambahkan pengguna ke database dan berikan **"ALL PRIVILEGES"**.

---

## Langkah 4: Konfigurasi Aplikasi

Hubungkan aplikasi ke database baru Anda.

1.  Di File Manager, navigasi ke folder `rim-landing-page` (di direktori `home` Anda).
2.  Klik kanan pada `config.php` dan pilih **"Edit"**.
3.  Isi kredensial database yang Anda catat pada Langkah 3.
4.  Klik **"Save Changes"**.

---

## Langkah 5: Jalankan Skrip Setup Database

Langkah terakhir untuk menginisialisasi tabel-tabel database.

1.  Buka browser Anda dan kunjungi URL **`http://yourdomain.com/setup.php`**.
2.  Anda akan melihat pesan sukses yang mengonfirmasi bahwa semua tabel telah dibuat.
3.  **SANGAT PENTING:** Setelah selesai, kembali ke File Manager dan **hapus file `setup.php`** dari folder `rim-landing-page/public` untuk mengamankan situs Anda.

---

## Instalasi Selesai!

Aplikasi Anda sekarang sudah terinstal dengan aman dan berjalan di domain utama Anda.
