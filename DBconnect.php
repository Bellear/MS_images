<?php
require 'DBconfig.php';
$dsn = 'mysql:host='. DB_HOST. ';dbname='. DB_NAME. ';charset='. DB_CHAR;
$pdo = new PDO($dsn, DB_LOG, DB_PASS);
?>
