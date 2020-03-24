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
    <a class="btn btn-outline-primary" href="../blocks/addimg.php">Добавить изображение</a>
    <div class="container mt-5">
      <h3 class="mb-5">Изображения, загруженные вами</h3>
      <div class="row">
        <?php
          require('../functions.php');
          $str_pag = show_content('profile');
        ?>
      </div>
    </div>
    <center>
      <?php
        for ($i = 1; $i <= $str_pag; $i++) {
            echo "<a href=$PHP_SELF?page=".$i."> Страница ".$i." </a>";
        }
      ?>
    </center>
  </body>
</html>
