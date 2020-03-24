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
      <form action="../imgaccess.php" method="post" enctype="multipart/form-data">
        <p><b>Прикрепите файл</b></p>
        <input type="file" class="form-control" name="file" placeholder="Прикрепите файл"><br>
        <input type="text" class="form-control" name="imgname" placeholder="Введите название изображения"><br>
        <input type="text" class="form-control" name="imgtags" placeholder="Введите теги (через запятую)"><br>
        <textarea class="form-control" rows="7" cols="70" name="story"></textarea><br>
        <button class="btn btn-success" type="submit">Отправить</button><br>
      </form>
    </div>
  </body>
</html>
