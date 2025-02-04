# V-SMART (Ventilator Smart)

V-SMART adalah aplikasi berbasis web yang dikembangkan oleh BPJS Soreang untuk monitoring pemakaian alat ventilator di rumah sakit yang menjadi bagian dari BPJS Soreang. Aplikasi ini membantu memastikan penggunaan alat ventilator sesuai dengan data yang valid dan mencegah fraud claim.

## 🚀 Fitur Utama

- **Monitoring Ventilator**: Memantau waktu penggunaan alat ventilator di rumah sakit.
- **Form Pemeriksaan**: Input data pemeriksaan alat ventilator oleh pihak rumah sakit.
- **Export Laporan**: Menghasilkan laporan pemeriksaan dalam format PDF.
- **Role-Based Access Control (RBAC)**: Hak akses berbeda untuk Admin (BPJS) dan User (Rumah Sakit).
- **Keamanan Tinggi**: Proteksi terhadap manipulasi data.
- **CAPTCHA pada Login**: Mencegah serangan bot pada halaman login.

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Frontend**: Tailwind CSS, Vue.js
- **Database**: MySQL
- **Tabel Data**: DataTables
- **Autentikasi**: Laravel Sanctum (jika diperlukan di masa depan)

## ⚙️ Instalasi dan Konfigurasi

### 1. Clone Repository
```bash
git clone https://github.com/username/vsmart.git
cd vsmart
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
Buat file `.env` dan atur database:
```bash
cp .env.example .env
```
Edit `.env`:
```env
DB_DATABASE=vsmart
DB_USERNAME=root
DB_PASSWORD=
```

Tambahkan konfigurasi reCAPTCHA:
```env
RECAPTCHA_SITE_KEY=your_site_key
RECAPTCHA_SECRET_KEY=your_secret_key
```

### 4. Generate Key dan Migrasi Database
```bash
php artisan key:generate
php artisan migrate --seed
```

### 5. Run Server
```bash
php artisan serve
```
Akses aplikasi di: `http://localhost:8000`

## 📝 Lisensi
V-SMART dikembangkan oleh **BPJS Soreang** dan tidak untuk penggunaan komersial.

---
Jika ada pertanyaan atau kontribusi, silakan buat **issue** atau **pull request** di repository ini! 😊

