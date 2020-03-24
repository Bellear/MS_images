<?php session_start(); ?>
<div class="container mt-5">
  <h3 class="mb-5">Картинки на сайте</h3>
  <div class="col">
      <center>
          <form action="/blocks/tegcheck.php" method="post">
            <input type="text" class="form-control" name="serchtag" placeholder="Поиск по тегу">
            <button class="btn btn-success" type="submit">Найти</button><br>
          </form>
      </center>
  </div>
  <div class="row">
        <?php
      require('functions.php');
      $str_pag = show_content('main');
    ?>
  </div>
</div>
<center>
  <?php
    for ($i = 1; $i <= $str_pag; $i++) {
        echo "<a href=..$PHP_SELF?page=".$i."> Страница ".$i." </a>";
    }
  ?>
</center>
