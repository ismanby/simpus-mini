<?php
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/koneksi.php';

$totalBuku = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
$totalAnggota = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
$totalDipinjam = $pdo->query("SELECT COUNT(*) FROM peminjaman WHERE status = 'Dipinjam'")->fetchColumn();
$totalTerlambat = $pdo->query(
    "SELECT COUNT(*) FROM peminjaman WHERE status = 'Dipinjam' AND tanggal_pinjam < CURRENT_DATE - 14"
)->fetchColumn();

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Selamat Datang di Sistem Perpustakaan Mini</h2>
            <?php if ($flash): ?>
                <p class="flash flash-<?php echo e($flash['type']); ?>"><?php echo e($flash['pesan']); ?></p>
            <?php endif; ?>
            <p>Aplikasi sederhana untuk mengelola data buku dan anggota perpustakaan.</p>
        </section>

        <section>
            <h2>Ringkasan</h2>
            <article>
                <h3>Total Buku</h3>
                <p><?php echo $totalBuku; ?></p>
            </article>
            <article>
                <h3>Total Anggota</h3>
                <p><?php echo $totalAnggota; ?></p>
            </article>            
            <article>
                <h3>Sedang Dipinjam</h3>
                <p><?php echo (int) $totalDipinjam; ?></p>
            </article>
            <article>
                <h3>Buku Terlambat</h3>
                <p><?php echo (int) $totalTerlambat; ?></p>
            </article>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>