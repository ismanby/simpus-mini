<?php
require __DIR__ . '/../includes/auth.php';
$page_title = "Edit Buku";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute(['id' => $id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
    header('Location: list.php');
    exit;
}
?>
        <section>
            <h2>Edit Buku</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <form id="form-tambah" method="post" action="proses_edit.php" novalidate>
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo $buku['id']; ?>">
                <p>
                    <label for="judul">Judul</label>
                    <input type="text" id="judul" name="judul" value="<?php echo e($buku['judul']); ?>" required>
                </p>
                <p>
                    <label for="pengarang">Pengarang</label>
                    <input type="text" id="pengarang" name="pengarang" value="<?php echo e($buku['pengarang']); ?>" required>
                </p>
                <p>
                    <label for="tahun">Tahun</label>
                    <input type="number" id="tahun" name="tahun" value="<?php echo e($buku['tahun']); ?>" required>
                </p>
                <p>
                    <label for="isbn">ISBN</label>
                    <input type="text" id="isbn" name="isbn" value="<?php echo e($buku['isbn']); ?>">
                </p>
                <p>
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" min="0" value="<?php echo e($buku['stok']); ?>" required>
                </p>
                <p>
                    <label for="kategori">Kategori</label>
                    <select id="kategori" name="kategori">
                        <?php foreach (['Fiksi' => 'Fiksi', 'Non-Fiksi' => 'Non-Fiksi', 'Pelajaran' => 'Pelajaran'] as $value => $label): ?>
                        <option value="<?php echo $value; ?>" <?php echo $buku['kategori'] === $value ? 'selected' : ''; ?>><?php echo $label; ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <button type="submit">Simpan Perubahan</button>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>