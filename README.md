# Sistem Keuangan STIKOM powered by CodeIgniter 4

## Installation
1. Masuk ke folder `/var/www/html` (**Linux**)  atau `htdocs` (Jika menggunakan XAMPP).
2. Clone repo ini dengan perintah:
 ```bash 
 git clone https://github.com/AlvifSandana/keuangan-stikom.git sistem-keuangan
 ```
3. Jalankan composer untuk memasang pustaka yang dibutuhkan:
 ```bash
 cd sistem-keuangan && composer install
 ```

## Setup

1. Copy `env` menjadi `.env`, lalu konfigurasi `baseURL`, `database`, dan konfigurasi lainnya di dalam file `.env` sesuai kebutuhan. 

2. Konfigurasi *Virtual Server* **Apache** maupun **Nginx** (sesuai kebutuhan) dengan membuat file konfigurasi baru dengan `DocumentRoot` **Apache** atau `root` **Nginx** diarahkan ke folder ***public*** mengingat file `index.php` pada CI4 terletak di folder ***public***.


**Please** read the user guide for a better explanation of how CI4 works!

## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
