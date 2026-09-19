<?php
session_start();

$no_anggota = trim($_POST['no_anggota'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');
$email = trim($_POST['email'] ?? '');
$tahun_bergabung = $_POST['tahun_bergabung'] ?? '';

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
    header('Location: tambah.php');
    exit;
}

if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}

$_SESSION['anggota'][] = [
    'no_anggota' => $no_anggota,
    'nama' => $nama,
    'alamat' => $alamat,
    'no_hp' => $no_hp,
    'email' => $email,
    'tahun_bergabung' => (int) $tahun_bergabung,
];

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil ditambahkan.'];
header('Location: list.php');
exit;