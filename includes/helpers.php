<?php
// includes/helpers.php
// Fungsi e() mencegah XSS dengan meng-escape karakter HTML khusus
// sebelum data ditampilkan ke browser.
function e($value)
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}