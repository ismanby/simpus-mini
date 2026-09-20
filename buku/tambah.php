<?php
$page_title = "Tambah Buku";
include __DIR__ . '/../includes/header.php';
?>
        <section>
            <h2>Tambah Buku</h2>
            <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
                <p>
                    <label for="judul">Judul</label>
                    <input type="text" id="judul" name="judul" required>
                </p>
                <p>
                    <label for="pengarang">Pengarang</label>
                    <input type="text" id="pengarang" name="pengarang" required>
                </p>
                <p>
                    <label for="tahun">Tahun</label>
                    <input type="number" id="tahun" name="tahun" required>
                </p>
                <p>
                    <label for="isbn">ISBN</label>
                    <input type="text" id="isbn" name="isbn">
                </p>
                <p>
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" min="0" required>
                </p>
                <p>
                    <label for="kategori">Kategori</label>
                    <select id="kategori" name="kategori">
                        <option value="Fiksi">Fiksi</option>
                        <option value="Non-Fiksi">Non-Fiksi</option>
                        <option value="Pelajaran">Pelajaran</option>
                    </select>
                </p>
                <button type="submit">Simpan</button>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>