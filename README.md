<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Sistem E-Disposisi
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



## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
