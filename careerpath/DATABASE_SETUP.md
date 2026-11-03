# Menyiapkan database CareerPath

## Hosting

1. Buat database MySQL/MariaDB dan pengguna database melalui panel hosting. Catat host, port, nama database, nama pengguna, dan kata sandi yang diberikan hosting.
2. Pilih database tersebut di phpMyAdmin, lalu impor `database.sql`. File SQL membuat tabel dan data contoh di database yang dipilih; file ini tidak membuat akun pengguna.
3. Atur variabel lingkungan PHP berikut pada konfigurasi hosting:

   - `CAREERPATH_DB_HOST`
   - `CAREERPATH_DB_PORT` (biasanya `3306`)
   - `CAREERPATH_DB_NAME` (gunakan nama lengkap yang diberikan hosting, termasuk awalan akun)
   - `CAREERPATH_DB_USER`
   - `CAREERPATH_DB_PASSWORD`

   Jangan masukkan kredensial database ke GitHub. Jika hosting tidak menyediakan konfigurasi variabel lingkungan, tanyakan kepada administrator hosting cara mengatur kredensial aplikasi PHP dengan aman.
4. Pastikan PHP mengaktifkan ekstensi `PDO` dan `pdo_mysql`, dan Apache mengizinkan aturan `.htaccess` di folder unggahan.
5. Daftarkan akun mahasiswa melalui `register.php` dan akun HRD melalui `register-company.php`. Kata sandi disimpan dalam bentuk hash.

## XAMPP lokal

Tanpa variabel lingkungan, koneksi menggunakan `127.0.0.1:3306`, database `careerpath`, pengguna `root`, dan kata sandi kosong. Buat database `careerpath` di phpMyAdmin, pilih database tersebut, lalu impor `database.sql`.
