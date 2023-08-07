# PHP MVC CRUD Mahasiswa (sedang dibuat)
CRUD Mahasiswa dengan PHP MVC menggunakan template AdminLTE

## Informasi singkat
Website ini dibuat dengan PHP menggunakan arsitektur MVC.<br>
Di websitenya bisa CRUD Mahasiswa, CRUD Jurusan, CRUD Mata kuliah, dan CRUD User (login, logout, register, edit profil, delete akun).<br>
Di saat menambah mahasiswa, hanya perlu memilih jurusan. Setiap jurusan sudah berisi mata kuliah.<br>
Saya menggunakan 1 tabel tambahan untuk menghubungkan 2 tabel didalam database.<br>

## Yang digunakan
- AdminLTE
- Bootstrap 4
- JQuery
- SweetAlert2
- Select2
- JSON Web Token

## Cara menggunakan
- Download semua file
- Siapkan database (db_siskampus.sql sebagai contoh)
- Pindahkan isi AdminLTE dari adminlte.io ke folder public/AdminLTE
- Sebelum menjalankan server, ketik "composer update"
- Jalankan server PHP di folder public
