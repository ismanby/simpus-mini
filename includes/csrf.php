<?php
// includes/csrf.php
// Mekanisme token CSRF: mencegah situs lain memicu POST palsu
// atas nama pengguna yang sedang login.

function csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field()
{
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}

function csrf_verify()
{
    $token = $_POST['csrf_token'] ?? '';
    if ($token === '' || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(403);
        die('Permintaan ditolak: token CSRF tidak valid atau kedaluwarsa.');
    }
}