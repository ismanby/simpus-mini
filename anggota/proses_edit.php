<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$id = $_POST['id'] ?? null;
$no_anggota = trim($_POST['no_anggota'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');
$email = trim($_POST['email'] ?? '');
$tahun_bergabung = $_POST['tahun_bergabung'] ?? '';

if (!$id) {
    header('Location: list.php');
    exit;
}

$errors = [];
if ($no_anggota === '') {
    $errors[] = "No. Anggota wajib diisi.";
}
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($alamat === '') {
    $errors[] = "Alamat wajib diisi.";
}
if (!is_numeric($tahun_bergabung) || $tahun_bergabung < 1900 || $tahun_bergabung > 2026) {
    $errors[] = "Tahun bergabung harus di antara 1900-2026.";
}
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Format email tidak valid.";
}
if ($no_hp !== '' && !preg_match('/^[0-9]+$/', $no_hp)) {
    $errors[] = "No. HP hanya boleh berisi angka.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}

try {
    $stmt = $pdo->prepare(
        "UPDATE anggota SET no_anggota = :no_anggota, nama = :nama, alamat = :alamat,
         no_hp = :no_hp, email = :email, tahun_bergabung = :tahun_bergabung WHERE id = :id"
    );
    $stmt->execute([
        'no_anggota' => $no_anggota,
        'nama' => $nama,
        'alamat' => $alamat,
        'no_hp' => $no_hp,
        'email' => $email,
        'tahun_bergabung' => (int) $tahun_bergabung,
        'id' => $id,
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil diperbarui.'];
    header('Location: list.php');
    exit;
} catch (PDOException $e) {
    if ($e->getCode() === '23505') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'No. Anggota sudah dipakai, gunakan nomor lain.'];
    } else {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Terjadi kesalahan saat menyimpan data.'];
    }
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}