<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_destroy();
setcookie('remember_user_id', '', time() - 3600, '/');
header('Location: login.php');
exit;