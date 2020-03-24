<?php session_start(); ?>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Картиночки мои
    <?php
      if ($_SESSION['name'] == "") {
          echo 'Hello, Guest';
      } else {
          echo 'Hello, '. $_SESSION['name'];
      }
    ?></h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="../">Главная</a>
    <?php if ($_SESSION['name'] == "") {
        echo '';
    } else {
        echo '<a class="p-2 text-dark" href="../blocks/profile.php">Личный кабинет</a>';
    }
    ?>
  </nav>
  <?php if ($_SESSION['name'] == "") {
        echo '<a class="btn btn-outline-primary" href="../blocks/register.php">Войти/Регистрация</a>';
    } else {
        echo '<a class="btn btn-outline-primary" href="../logout.php">Выйти</a>';
    }
  ?>

</div>
