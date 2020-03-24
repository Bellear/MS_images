<?php
require('DBconnect.php');
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
$pass = md5($pass."voodoo");

if (mb_strlen($login) < 3 || mb_strlen($login) > 15) {
    echo "Требуется длина логина от 3 до 15 символов";
    exit();
} elseif (mb_strlen($pass) < 5 || mb_strlen($login) > 50) {
    echo "Требуется длина пароля от 5 до 30 символов";
    exit();
}

$sql = 'INSERT INTO users(name, password) VALUES(:login, :pass)';
  $query = $pdo->prepare($sql);
  $query->execute(['login' => $login, 'pass' => $pass]);

header('location: /');
