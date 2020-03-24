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
    require('../functions.php');
    $row = add_view();
    ?>
  <center>
    <div class="card text-center" style="width: 50%;">
      <img class="card-img-center" src="<?php echo "../$row[path]" ?>" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><?php echo "$row[name]" ?></h5>
        <p class="card-text"><?php echo "$row[description]" ?></p>
        <p class="card-text"><?php echo "Выложил: $row[author]" ?></p>
        <p class="card-text"><small class="text-muted"><?php echo "Просмотров: $row[views]" ?></small></p>
      </div>
    </div>
  </center>
</html>
