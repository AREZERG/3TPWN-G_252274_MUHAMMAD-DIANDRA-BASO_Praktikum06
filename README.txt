PRAKTIKUM 06 - PERPUS MINI
Pemrograman Web Native

CARA MENJALANKAN
1. Ekstrak folder Praktikum06_PerpusMini.
2. Pindahkan folder ke web root:
   - Laragon: C:\laragon\www\
   - XAMPP:   C:\xampp\htdocs\
3. Pastikan Apache berjalan.
4. Buka browser:
   http://localhost/Praktikum06_PerpusMini/
5. Jika ingin URL persis seperti modul, ubah nama folder menjadi perpusmini,
   lalu buka http://localhost/perpusmini/.

BERKAS
- index.php               halaman utama, data buku, form POST, pencarian GET
- fungsi.php              konstanta dan function PHP
- partials/header.php     kepala halaman dan navigasi
- partials/sidebar.php    pencarian, kategori, dan form tambah buku
- partials/footer.php     footer dan tanggal server
- style.css               tampilan halaman

FITUR CHECKPOINT / MODIFIKASI BAGIAN 6
- Array multidimensi dan foreach.
- Form POST dengan validasi judul/penulis.
- htmlspecialchars untuk output.
- require dan __DIR__ untuk partials.
- labelStok() untuk status stok.
- labelTahun() untuk menampilkan dekade tahun.
- cariBuku() mencari pada judul DAN penulis dengan array_filter,
  str_contains, serta strtolower.
- Header menampilkan jumlah hasil pencarian.
- Footer menampilkan tanggal server zona Asia/Makassar.

CATATAN
Data buku hanya disimpan di array selama request berjalan. Buku yang ditambahkan
akan terlihat pada hasil submit, tetapi akan hilang ketika halaman dimuat ulang,
sesuai keterangan modul bahwa penyimpanan database dibahas pada modul berikutnya.
