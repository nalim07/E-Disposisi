<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 📄 Sistem E-Disposisi Surat Masuk, Surat Keluar, dan Arsip

Sistem ini merupakan aplikasi manajemen surat digital yang dibangun menggunakan **Laravel**.  
Fokus sistem adalah untuk mengelola **surat masuk**, **disposisi**, **surat keluar**, dan **arsip surat** di sebuah instansi.

---

## 🚀 Fitur Utama

1. **Surat Masuk**
   - Input surat masuk (nomor surat, tanggal, pengirim, perihal, dll)
   - Upload file surat
   - Edit & hapus surat
   - Lihat daftar surat masuk

2. **Disposisi**
   - Tambah disposisi dari surat masuk
   - Tentukan penerima disposisi (user)
   - Set batas waktu & prioritas
   - Tambah catatan disposisi
   - Edit & hapus disposisi

3. **Surat Keluar**
   - Input surat keluar
   - Upload file surat keluar
   - Edit & hapus surat keluar
   - Lihat daftar surat keluar

4. **Arsip**
   - Penyimpanan digital untuk semua surat keluar
   - Filter berdasarkan kategori, tanggal, atau kata kunci
   - Download arsip surat

5. **User Management**
   - Role pengguna (Admin, Pimpinan, Pegawai)
   - Login & logout
   - Hak akses sesuai role

---

## 📂 Struktur Database Utama

- **incoming_mails** → Surat masuk
- **dispositions** → Disposisi surat
- **outgoing_mails** → Surat keluar
- **archives** → Arsip surat
- **users** → Data pengguna

---

---
## Panduan Instalasi dan Menjalankan Website

📝 **Panduan ini untuk pemula!** Ikuti langkah-langkah berikut dengan hati-hati 🛠️

---

## 📋 Persyaratan Sistem
Sebelum memulai, pastikan komputer Anda sudah terinstall:
1. **PHP 8.2+** ([Download](https://www.php.net/downloads.php))
2. **Node.js** (versi LTS disarankan) ([Download](https://nodejs.org))
3. **Composer** ([Download](https://getcomposer.org))
4. **Laragon 6** ([Download](https://github.com/leokhoa/laragon/releases))
5. **Git** ([Download](https://git-scm.com/downloads))
6. **Visual Studio Code** (atau editor lain) ([Download](https://code.visualstudio.com))

---

## � Cara Install

### 1. Clone Repository
```bash
# Buka terminal di folder yang diinginkan (bisa klik kanan > Git Bash Here)
git clone https://github.com/nalim07/E-Disposisi.git
```

### 2. Masuk ke Folder Project
```bash
cd .\E-Diposisi\
```

### 3. Install Dependencies
```bash
# Install PHP packages
composer install

# Install JavaScript packages
npm i
```

### 4. Setup Environment
```bash
# Salin file environment
copy .env.example .env  # Untuk Windows
# atau
cp .env.example .env    # Untuk Linux/Mac

# Generate application key
php artisan key:generate
```
### 5. Database Setup
```bash
# Jalankan migration + seeding
php artisan migrate --seed
```

---

## 🚀 Menjalankan Aplikasi
### Cara 1: Menggunakan Terminal
```bash
# Buka DUA terminal terpisah

# Terminal 1: Jalankan web server
php artisan serve

# Terminal 2: Jalankan Vite untuk frontend
npm run dev
```
### Cara 2: Menggunakan Laragon
- Buka Laragon
- Start semua service (Apache, MySQL, dll)
- Klik menu  > pilih www > pilih e-disposisi
- Akses via http://e-diposisi.test

---

## 🌐 Akses Aplikasi
Buka browser dan kunjungi:
```bash
http://localhost:8000
```
atau
```bash
http://e-diposisi.test (jika pakai Laragon)
```

---

## 📞 Butuh Bantuan?
Hubungi developer:
📧 Email: alim.nur7799@gmail.com
📸 Instagram: [@n_alim07](https://instagram.com/n_alim07)

#### ✨ Selamat! Aplikasi sudah berjalan di komputer Anda! ✨
