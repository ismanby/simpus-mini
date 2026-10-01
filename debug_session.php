<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Debug Session</title>
</head>
<body>
    <h1>Isi $_SESSION saat ini</h1>
    <pre><?php print_r($_SESSION); ?></pre>
</body>
</html>