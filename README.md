# PHP MVC CRUD Mahasiswa
Website Create, Read, Update, Delete (CRUD) Mahasiswa dengan PHP MVC menggunakan template AdminLTE

## Informasi singkat
- Website ini dibuat dengan PHP menggunakan arsitektur MVC.<br>
- Dalam website ini bisa CRUD Mahasiswa, CRUD Jurusan, CRUD Mata kuliah, dan CRUD User (login, logout, register, edit profil, delete akun).<br>
- Saat menambah (Create) mahasiswa, hanya perlu memilih 1 jurusan. Setiap jurusan sudah berisi mata kuliah.<br>
- Saya menggunakan 1 tabel tambahan untuk menghubungkan 2 tabel didalam database.<br>

## Teknologi yang digunakan
- AdminLTE
- Bootstrap 4
- JQuery
- SweetAlert2
- Select2
- JSON Web Token

## Instalasi atau Cara menggunakan
- Proses download
1. Pastikan Anda sudah menginstall [XAMPP](https://www.apachefriends.org/download.html) dan [Composer](https://getcomposer.org/) di komputer Anda
2. Download semua file di repository ini
3. Ekstrak file jika hasil download berupa file `.zip`
4. Download [AdminLTE](https://adminlte.io/) dan isinya dipindahkan ke folder `php-mvc-crud-mahasiswa-main/public/AdminLTE/`
- Proses pengaturan
6. Start *Apache* dan *MySQL* di XAMPP Control Panel
7. Buka `localhost/phpmyadmin` di browser
8. Buat database baru dengan nama `db_siskampus`
9. Klik tulisan *Import* di bagian atas
10. Di bagian *File to import:* pilih file `db_siskampus.sql` yang ada di folder `php-mvc-crud-mahasiswa-main/`
11. Kalau sudah, klik tombol *Import* di bagian paling bawah
- Proses menjalankan website
12. Buka folder `php-mvc-crud-mahasiswa-main/` di *Command Prompt*
13. Ketik `composer update` untuk men-download hal yang dibutuhkan website
14. Pindah ke folder public dengan mengetik `cd public` di *Command Prompt*
15. Jalankan server PHP dengan mengetik `php -S localhost:8080`
16. Akses website dari Web Browser ke alamat localhost:8080

## Informasi tambahan
- Saat membuka website pertama kali, akan diarahkan ke halaman login (akan otomatis ke alamat localhost:8080/login)
- Di halaman registrasi dapat membuat akun untuk login
- Setelah login diarahkan ke halaman dashboard yang berisi daftar mahasiswa
- Selebihnya bisa eksplorasi untuk mengetahui lebih lanjut
