<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Картиночки</title>
</head>
  <body>
    <?php
    require('header.php');
    ?>
    <div class="container mt-4">
      <div class="row">
        <div class="col">
          <h5>Регистрация</h5>
          <form action="../adduser.php" method="post">
            <input type="text" class="form-control" name="login" placeholder="Введите логин"><br>
            <input type="text" class="form-control" name="pass" placeholder="Введите пароль"><br>
            <button class="btn btn-success" type="submit">Зарегистрировать</button><br>
          </form>
        </div>
        <div class="col">
          <h5>Авторизация</h5>
            <form action="../auth.php" method="post">
              <input type="text" class="form-control" name="login" placeholder="Введите логин"><br>
              <input type="text" class="form-control" name="pass" placeholder="Введите пароль"><br>
              <button class="btn btn-success" type="submit">Войти</button><br>
            </form>
        </div>
      </div>
  </body>
</html>
