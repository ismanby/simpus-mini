<?php
$page_title = "Tambah Anggota";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Tambah Anggota</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
                <p>
                    <label for="no_anggota">No. Anggota</label>
                    <input type="text" id="no_anggota" name="no_anggota" required>
                </p>
                <p>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" required>
                </p>
                <p>
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required>
                </p>
                <p>
                    <label for="no_hp">No. HP</label>
                    <input type="text" id="no_hp" name="no_hp" required>
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </p>
                <p>
                    <label for="tahun_bergabung">Tahun Bergabung</label>
                    <input type="number" id="tahun_bergabung" name="tahun_bergabung" required>
                </p>
                <button type="submit">Simpan</button>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>