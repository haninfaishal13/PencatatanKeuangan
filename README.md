<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<h1 align="center">Aplikasi Pencatatan Keuangan</h1>

## Tentang Aplikasi

Aplikasi Pencatatan Keuangan adalah aplikasi yang bisa membantu anda dalam mencatatat pengeluaran dan pemasukan anda. Aplikasi ini juga dapat digunakan untuk memantau untuk apa saja pengeluaran anda. Aplikasi ini menggunakan REST API sehingga dapat dimanfaatkan untuk project menggunakan teknologi frontend yang lain

## Versi Aplikasi

- PHP 7.4.*
- Laravel 8.83.*
- Composer 2.2.*
- PostgreSQL 12.*

## Panduan Instalasi

1. Download atau Clone aplikasi ini dari Github ke komputer lokal anda
2. Buat file `.env` baru, lalu atur koneksi database aplikasi ini pada file `.env`. Contoh pengaturan file `.env` ada pada file `.env.example`
3. Buat database sesuai dengan yang telah diatur pada file `.env`
4. Migrasi database dengan menjalankan `php artisan migrate`, lalu jalankan seeder dengan `php artisan db:seed DatabaseSeeder` di command prompt atau terminal
5. Jalankan web server Laravel dengan jalankan perintah `php artisan serve` di command prompt atau terminal, atau atur virtual host pada web server lokal anda
6. Untuk membuka halaman awal, anda bisa buka pada path `/frontend` untuk contoh tampilan yang sudah dibuat

## Catatan

Dokumentasi dari aplikasi ini terdapat pada file PencatatanKeuangan.postman_collection di dalam project ini. Dokumentasi tersebut dapat diakses lewat aplikasi postman, dengan mengimport file tersebut ke dalam aplikasi postman. 
