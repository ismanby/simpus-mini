<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

csrf_verify();

if ($_SESSION['role'] !== 'Admin') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Hanya Admin yang boleh menghapus anggota.'];
    header('Location: list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = $_POST['id'] ?? null;
if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM anggota WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil dihapus.'];
    } catch (PDOException $e) {
        if ($e->getCode() === '23503') {
            $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Anggota tidak bisa dihapus karena sudah punya riwayat peminjaman.'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Terjadi kesalahan saat menghapus data.'];
        }
    }
}
header('Location: list.php');
exit;