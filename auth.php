<?php
session_start();
require('DBconnect.php');
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
$pass = md5($pass."voodoo");

$query = $pdo->query("SELECT * FROM users WHERE name = '$login' AND password = '$pass'");
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user == false) {
    echo "Такой связки логин-пароль не существует";
    exit();
}

$_SESSION['name'] = $login;
header("Location: /");
