# Security Checklist — SIMPUS-Mini

| # | Kerentanan | Ditemukan di | Sebelum | Sesudah (perbaikan) |
|---|---|---|---|---|
| 1 | SQL Injection | buku/, anggota/, auth/ | Audit ulang — semua query sudah pakai prepared statement sejak Jobsheet 8 | Dikonfirmasi aman. Diuji input `' OR '1'='1` di form login → tidak berhasil bypass |
| 2 | XSS | buku/list.php, edit.php, anggota/list.php, edit.php, header.php | Output data (`judul`, `nama`, dll) dicetak langsung lewat `echo` tanpa escaping | Dibungkus fungsi `e()` (`htmlspecialchars` + `ENT_QUOTES`). Diuji judul `<script>alert(1)</script>` → tampil sebagai teks, bukan pop-up |
| 3 | CSRF | Semua form POST (buku/, anggota/, auth/) | Form tidak punya token, permintaan POST bisa dipicu dari situs lain | Token tersembunyi (`csrf_field()`) di semua form, diverifikasi (`csrf_verify()`) sebelum menyentuh database. Diuji lewat curl tanpa token → HTTP 403 |
| 4 | Validasi & Sanitasi Input | buku/edit.php, anggota/edit.php | Validasi tipe & wajib-isi sudah ada sejak Jobsheet 7-9, tapi hidden input id belum di-cast eksplisit | Ditambah `(int)` eksplisit pada value hidden input id |
| 5 | Session Fixation | auth/proses_login.php, includes/auth.php | Session ID tidak berubah setelah login, berpotensi "dibajak" bila sudah diketahui penyerang sebelumnya | `session_regenerate_id(true)` dipanggil setelah login berhasil, termasuk saat sesi dipulihkan dari cookie Remember Me |
| 6 | Kebocoran Error Mentah | anggota/proses_tambah.php, anggota/proses_edit.php | Sebelum Jobsheet 8 latihan tambahan, error `UNIQUE constraint` dari PostgreSQL tampil mentah ke pengguna (`SQLSTATE[23505]...`), membocorkan detail struktur database | Dibungkus `try`/`catch (PDOException $e)`, menampilkan pesan ramah lewat flash message. Diuji dengan menambah No. Anggota yang sudah ada → muncul pesan "No. Anggota sudah dipakai", bukan error mentah |

## Catatan Implementasi

- `includes/auth.php` (guard login) selalu dijalankan **sebelum** `includes/csrf.php` di halaman proses, memastikan pengguna yang belum login tidak bisa memicu pengecekan CSRF sama sekali — langsung di-redirect ke login.
- Kolom `tahun`, `stok`, `tahun_bergabung` tidak dibungkus `e()` karena bertipe `INTEGER` di database, tidak mungkin berisi tag HTML.