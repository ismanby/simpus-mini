<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

csrf_verify();

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$batasPercobaan = 5;
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = [];
}

$percobaanSaatIni = $_SESSION['login_attempts'][$username] ?? 0;
if ($percobaanSaatIni >= $batasPercobaan) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Terlalu banyak percobaan gagal. Coba lagi nanti.'];
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    unset($_SESSION['login_attempts'][$username]);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];

    if (isset($_POST['remember'])) {
        setcookie('remember_user_id', $user['id'], time() + 30 * 24 * 60 * 60, '/');
    }

    header('Location: ../index.php');
    exit;
}

$_SESSION['login_attempts'][$username] = $percobaanSaatIni + 1;
$sisaPercobaan = $batasPercobaan - $_SESSION['login_attempts'][$username];

if ($sisaPercobaan <= 0) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Terlalu banyak percobaan gagal. Coba lagi nanti.'];
} else {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => "Username atau password salah. Sisa percobaan: $sisaPercobaan."];
}
header('Location: login.php');
exit;