<?php
session_start();
require('functions.php');
if (empty($_FILES['file']['name'])) {
    exit("Вы не добавили изображение");
}
if (empty($_POST['imgname'])) {
    exit("Введите название изображения");
}

require('DBconnect.php');
$author = $_SESSION['name'];
$imgname = strip_tags($_POST['imgname']);
$description = strip_tags($_POST['story']);

$check = can_upload($_FILES['file']);
if ($check == true) {
    $path = make_upload($_FILES['file']);
} else {
    echo "$check";
}

$author = $_SESSION['name'];
$imgname = strip_tags($_POST['imgname']);
$description = strip_tags($_POST['story']);

$sql = 'INSERT INTO images(name, description, author, path) VALUES(:name, :description, :author, :path)';
$query = $pdo->prepare($sql);
$query->execute(['name' => $imgname, 'description' => $description, 'author' => $author, 'path' => $path]);

$lastimg_id = $pdo->lastInsertId();;

if (isset($_POST['imgtags'])) {
    $keywords = $_POST["imgtags"];
    $tags = explode(",", $keywords);
    $i=0;

    do {
        $result_chars = trim($tags[$i]);
        $query = $pdo->query("SELECT * FROM tags WHERE tag = '$result_chars'");
        $tag_in = $query->fetch(PDO::FETCH_ASSOC);
        if ($tag_in == false) {
            $sql = 'INSERT INTO tags(tag) VALUES(:tag)';
            $query = $pdo->prepare($sql);
            $query->execute(['tag' => $result_chars]);
            $lasttag_id = $pdo->lastInsertId();
            ;

            $sql = 'INSERT INTO images_tags(image_id, tags_id) VALUES(:imgid, :tagid)';
            $query = $pdo->prepare($sql);
            $query->execute(['imgid' => $lastimg_id, 'tagid' => $lasttag_id]);
        } else {
            $sql = 'INSERT INTO images_tags(image_id, tags_id) VALUES(:imgid, :tagid)';
            $query = $pdo->prepare($sql);
            $query->execute(['imgid' => $lastimg_id, 'tagid' => $tag_in['id']]);
        }
        $i++;
    } while ($tags[$i]!="");
}


header("Location: /");
