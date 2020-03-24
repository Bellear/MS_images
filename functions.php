<?php

function can_upload($file)
{ //валидация загружаемого файла
    if ($file['size'] == '0') {
        return 'Недопустимый размер файла';
    }
    $getMime = explode('.', $file['name']);
    $mime = mb_strtolower(end($getMime));
    $types = array('jpg', 'png', 'bmp', 'jpeg');
    if (!in_array($mime, $types)) {
        return 'Недопустимый формат файла';
    }
    return true;
}

function make_upload($file)
{ // сохранение изображения пользователя
    $name = date("Y-m-d H-i-s") . $file['name'];
    copy($file['tmp_name'], __DIR__ . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $name);
    return 'img' . DIRECTORY_SEPARATOR . $name;
}

function add_img($user, $name, $text)
{
    require 'DBconnect.php';
    $sql = 'INSERT INTO uploaded_images(user, name, text) VALUES(:user, :name, :text)';
    $query = $pdo->prepare($sql);
    $query->execute(['user' => $user, 'name' => $name, 'text' => $text]);
}

function add_view()
{
    require('DBconnect.php');
    $sql = ("UPDATE images SET views = views + 1 WHERE id = '$_GET[id]'");
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $query = $pdo->query("SELECT * FROM images WHERE id = '$_GET[id]'");
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function show_content($x)
{
    require('DBconnect.php');
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $kol = 3;  //количество записей для вывода
    $art = ($page * $kol) - $kol; // определяем, с какой записи нам выводить

    if ($x == 'main') {
        $total=$pdo->query("SELECT COUNT(*) as count FROM images")->fetchColumn();
        $str_pag = ceil($total / $kol);
        $query = $pdo->query("SELECT * FROM images ORDER BY id DESC LIMIT $art,$kol");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $brief = mb_strimwidth("$row[description]", 0, 70, "..."); ?>
              <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                  <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="<?php echo "$row[path]" ?>" data-holder-rendered="true">
                    <div class="card-body" style="height: 225px;">
                        <p class="card-text"><?php echo "$row[name]" ?></p>
                        <p class="card-text"><?php echo "$brief" ?></p>
                        <p class="card-text"><?php echo "Выложил: $row[author]" ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <?php echo "<a href='../blocks/imgdetail.php?id=$row[id]' class='btn btn-secondary btn-sm' role='button' aria-pressed='true'>Подробнее</a>"; ?>
                            <small class="text-muted"><?php echo "Просмотров: $row[views]" ?></small>
                        </div>
                        <?php
                        $query2 = $pdo->query("SELECT * FROM tags, images_tags
                                               WHERE tags.id = images_tags.tags_id
                                               AND images_tags.image_id = $row[id]");
            echo "Теги: ";
            while ($tags = $query2->fetch(PDO::FETCH_ASSOC)) {
                echo " /$tags[tag]/";
            } ?>
                    </div>
                </div>
              </div>
            <?php
        }
        return $str_pag;
    }
    if ($x == 'profile') {
        $auth = $_SESSION['name'];
        $total=$pdo->query("SELECT COUNT(*) as count FROM images WHERE author = '$auth'")->fetchColumn();
        $str_pag = ceil($total / $kol);
        $query = $pdo->query("SELECT * FROM images WHERE author = '$auth' ORDER BY id DESC LIMIT $art,$kol");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $brief = mb_strimwidth("$row[description]", 0, 100, "..."); ?>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="<?php echo "../$row[path]" ?>" data-holder-rendered="true">
                  <div class="card-body" style="height: 225px;">
                      <p class="card-text"><?php echo "$row[name]" ?></p>
                      <p class="card-text"><?php echo "$brief" ?></p>
                      <p class="card-text"><?php echo "Выложил: $row[author]" ?></p>
                      <div class="d-flex justify-content-between align-items-center">
                      <?php echo "<a href='../blocks/imgdetail.php?id=$row[id]' class='btn btn-secondary btn-sm' role='button' aria-pressed='true'>Подробнее</a>"; ?>
                      <small class="text-muted"><?php echo "Просмотров: $row[views]" ?></small>
                    </div>
                  </div>
              </div>
            </div>
          <?php
        }
        return $str_pag;
    }
}
function teg_serch($tag)
{
    require('DBconnect.php');
    $kol = 3;  //количество записей для вывода
    $art = ($page * $kol) - $kol; // определяем, с какой записи нам выводить

    $query1 = $pdo->query("SELECT * FROM tags WHERE tag = '$tag'");
    $row1 = $query1->fetch(PDO::FETCH_ASSOC);
    //var_dump($row1);
    if ($row1 == false) {
        echo('Изображений с таким тегом не существует');
    } else {
        $tagid = $row1['id'];

        $total=$pdo->query("SELECT COUNT(*) as count FROM images, images_tags
                                                     WHERE images.id = images_tags.image_id
                                                     AND images_tags.tags_id = $tagid")->fetchColumn();
        $str_pag = ceil($total / $kol);
        $query = $pdo->query("SELECT * FROM images, images_tags
                                                     WHERE images.id = images_tags.image_id
                                                     AND images_tags.tags_id = $tagid");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $brief = mb_strimwidth("$row[description]", 0, 70, "..."); ?>
              <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                  <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="<?php echo "../$row[path]" ?>" data-holder-rendered="true">
                    <div class="card-body" style="height: 225px;">
                        <p class="card-text"><?php echo "$row[name]" ?></p>
                        <p class="card-text"><?php echo "$brief" ?></p>
                        <p class="card-text"><?php echo "Выложил: $row[author]" ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <?php echo "<a href='../blocks/imgdetail.php?id=$row[id]' class='btn btn-secondary btn-sm' role='button' aria-pressed='true'>Подробнее</a>"; ?>
                            <small class="text-muted"><?php echo "Просмотров: $row[views]" ?></small>
                        </div>
                        <?php
                        $query2 = $pdo->query("SELECT * FROM tags, images_tags
                                               WHERE tags.id = images_tags.tags_id
                                               AND images_tags.image_id = $row[id]");
            echo "Теги: ";
            while ($tags = $query2->fetch(PDO::FETCH_ASSOC)) {
                echo " /$tags[tag]/";
            } ?>
                    </div>
                </div>
              </div>
            <?php
        }
    }
}
?>
