# UAS Rekayasa Perangkat Lunak

Nama: Muhamad Nikmal Wahid 
Kelas: TI 24 A3 
NIM: 312410372 

# Sistem Informasi Perpustakaan Berbasis Web

Aplikasi Sistem Informasi Perpustakaan Berbasis Web ini dikembangkan untuk membantu pengelolaan data buku, anggota, serta transaksi peminjaman dan pengembalian buku secara terintegrasi.
Sistem dibangun menggunakan arsitektur Model–View–Controller (MVC) agar struktur kode lebih terorganisir, terukur, dan mudah dikembangkan. 

```
Sandi Admin
email:adminperpus@gmail.com
password:admin123456
```

```
Sandi User (Test)
email:anggota1@gmail.com
password:anggota1
```


# Fitur Utama 

## 1. Manajemen Data (CRUD) 
### Manajemen Buku

- Menambahkan data buku baru.
- Menampilkan daftar buku.
- Mengubah data buku.
- Menghapus data buku.
- Pengelolaan stok buku secara otomatis.

### Manajemen Anggota 

- Menambahkan dan mengelola data anggota.
- Mengaktifkan dan menonaktifkan status anggota.
- Menampilkan daftar anggota.
- Validasi anggota sebelum melakukan peminjaman.

## 2. Transaksi Peminjaman Buku
### Peminjaman Buku

- Anggota dapat melakukan peminjaman buku.
- Sistem mengecek ketersediaan stok.
- Admin melakukan persetujuan (approve) peminjaman.

### Pengembalian Buku

- Menyelesaikan transaksi peminjaman.
- Mengubah status peminjaman menjadi selesai.
- Stok buku otomatis bertambah kembali.

### Pengelolaan Stok

- Stok berkurang saat peminjaman disetujui.
- Stok bertambah saat buku dikembalikan.

## 3. Penglolaan Denda 

- Pencatatan denda akibat keterlambatan pengembalian
- Menampilkan status denda anggota.
- Fitur Pelunasan denda

## 4. Laporan Perpustakaan
### Laporan Transaksi 

- Total peminjaman berdasarkan periode tanggal.
- Total pengembalian.
- Total anggota.
- Total buku.

### Export PDF 

- Export laporan ke format PDF
- Filter laporan berdasarkan tanggal
- File siap cetak dan arsip

## 5. Autentikasi dan Otorisasi 

- Login Admin
- Login Anggota
- Pembatasan akses halaman berdasarkan role





