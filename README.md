# Backend Assessment (Heru Prasetyo)

## Requirements

-   PHP 8.0 or higher
-   Database (eg: MySQL)
-   Web Server (eg: Apache, Nginx, IIS)

## Framework

Applikasi ini dibuat menggunakan [Laravel](http://laravel.com), Framework PHP paling baik menurut saya, sebagai rangka dasar untuk membuat Applikasi.

## Installation

-   Install [Composer](https://getcomposer.org/download)
-   Clone repository: `git clone https://anaknegeri@bitbucket.org/anaknegeri/rolling-glory.git`
-   Install dependencies: `composer install`

#### Buat file .env

```sh
$ cp .env.example .env
$ php artisan key:generate
```

#### Configurasi databse di file .env

Buat database terlebih dahulu kemudian edit file .env
Setelah selesai ikuti langkah salanjutnya:

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=root
```

### Membuat Table

Import database yang berada di dalam folder `/docs/dev_test114.sql`

### Menjalankan Server

Kita sudah sampai di langkah terakhir penginstallan, ketik kode dibawah untuk menjalankan server.

```sh
$ php artisan serve
```

Buka alamat url dibawah ini

```sh
http://127.0.0.1:8000
```


## Demo

Demo Applikasi dapat dilihat [disini](https://herupras-pitjarus.herokuapp.com/)


## 🚀 About Me

Saya adalah seorang Backend Web Developer, saya bisa menggunakan Bahasa pemprograman PHP bisanya saya menggunakan Framework Laravel, dan saya bisa membuat applikasi android menggunakan JAVA , saya juga bisa membuat API dengan Laravel, Lumen ataupun Nodejs & ExpressJS.
