=========================================================
 SKANDA - Website PPDB SMK Negeri 2 Karanganyar
=========================================================

PERUBAHAN DARI VERSI SEBELUMNYA (muhpat)
-----------------------------------------
1. Bug diperbaiki: file skema database (tabel admin & pendaftaran)
   sebelumnya tidak disertakan dalam project, sehingga aplikasi akan
   error saat pertama kali dijalankan. Sekarang disertakan file
   "database_skanda.sql" yang siap diimpor.
2. Rebrand: SMP Muhammadiyah 4 Mojogedang -> SMK Negeri 2 Karanganyar
   (SKANDA), termasuk seluruh teks, judul halaman, dan identitas visual.
3. Warna tema utama Hijau -> Dark Blue (biru tua) di seluruh halaman.
4. Fitur baru: Halaman "Jurusan" untuk 4 kompetensi keahlian:
   - Teknik Mesin       (identitas warna: Biru)
   - Teknik Tekstil     (identitas warna: Oranye)
   - Teknik Ototronik   (identitas warna: Merah)
   - Rekayasa Perangkat Lunak / RPL (identitas warna: Hijau)
   Admin dapat mengedit nama, ikon, warna identitas, dan deskripsi
   tiap jurusan melalui menu "Kelola Jurusan" di panel admin.

CARA INSTALASI
-----------------------------------------
1. Ekstrak file ZIP ini ke folder web server Anda, misalnya:
   - XAMPP  : htdocs/skanda
   - Laragon: www/skanda

2. Buat database melalui phpMyAdmin:
   - Buka phpMyAdmin, klik tab "Import"
   - Pilih file "database_skanda.sql" yang ada di paket ini
   - Klik "Go" / "Kirim"
   - Database "db_skanda" beserta tabel admin, pendaftaran, dan
     jurusan akan otomatis terbuat, lengkap dengan data awal.

3. Pastikan pengaturan koneksi database di
   application/config/database.php sudah sesuai dengan server Anda
   (secara default sudah diset host=localhost, user=root, password
   kosong, database=db_skanda — sesuai pengaturan XAMPP/Laragon default).

4. Buka website melalui browser, contoh:
   http://localhost/skanda/

AKUN ADMIN DEFAULT
-----------------------------------------
   URL Login : http://localhost/skanda/admin
   Username  : admin
   Password  : admin123

   PENTING: Segera ganti password ini setelah berhasil login pertama
   kali (tambahkan menu ganti password jika diperlukan), karena
   password ini adalah password bawaan/default.

STRUKTUR HALAMAN BARU
-----------------------------------------
   - Publik : /jurusan            -> daftar semua jurusan
   - Publik : /jurusan/detail/mesin, /tekstil, /ototronik, /rpl
   - Admin  : /admin/jurusan      -> kelola daftar jurusan
   - Admin  : /admin/jurusan_edit/{id} -> edit satu jurusan

Jika masih menemukan bug atau ingin penyesuaian lebih lanjut
(misalnya menambah/menghapus jurusan, upload gambar per jurusan,
atau mengganti akun admin default), silakan sampaikan kembali.
