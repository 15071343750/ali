<?php
header("content-type:text/html;charset=utf8");
include_once '../common/prevent.php';
$txt = $_POST['text'];
$picLink = $_POST['link'];

$picPath = '';
if ($_FILES['image']['error'] == 0) {
    $ext = strrchr($_FILES['image']['name'], '.');
    $picPath = '../uploads/P' . date('YmdHis-') . mt_rand(1000, 9999) . $ext;
    move_uploaded_file($_FILES['image']['tmp_name'], $picPath);
}
include_once '../common/mysql_connect.php';
$sql = "insert into ali_pic(pic_id, pic_path, pic_txt, pic_link) VALUES (NULL, '$picPath', '$txt', '$picLink')";
mysql_query($sql);
$num = mysql_affected_rows($link);
if ($num > 0) {
    echo '新图片添加成功';
} else {
    echo '新图片添加失败';
}
header("refresh: 2; url = slides.php");