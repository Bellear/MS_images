<?php
require('DBconnect.php');
$query = $pdo->query("SELECT * FROM images WHERE id = '$_GET[id]'");
$row = $query->fetch(PDO::FETCH_ASSOC);
unlink("$row[path]");
$query = $pdo->query("DELETE FROM images WHERE id = '$_GET[id]'");
header('Location: /');
