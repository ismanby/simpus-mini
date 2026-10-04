<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = "Registrasi Petugas";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Registrasi Petugas</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <form method="post" action="proses_register.php" novalidate>
                <?php echo csrf_field(); ?>
                <p>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" required>
                </p>
                <p>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" minlength="6" required>
                </p>
                <button type="submit">Daftar</button>
            </form>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>