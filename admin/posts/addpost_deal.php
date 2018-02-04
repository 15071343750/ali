<?php
header("content-type:text/html;charset=utf8");
include_once '../common/prevent.php';
$title = $_POST['title'];
$content = $_POST['content'];
$slug = $_POST['slug'];
$category = $_POST['category'];
$created = strtotime($_POST['created']);
$status = $_POST['status'];

$desc = substr($content, 0, 300);
$author = $_SESSION['userId'];
$uptime = $created;
$click = mt_rand(400, 600);
$good = mt_rand(100, 200);
$bad = mt_rand(10, 50);

$upfilePath = 'null';
if ($_FILES['feature']['error'] == 0) {
    $ext = strrchr($_FILES['feature']['name'], '.');
    $upfilePath = "../uploads/" . time() . mt_rand(100, 999) . $ext;
    move_uploaded_file($_FILES['feature']['tmp_name'], $upfilePath);
}

include_once '../common/mysql_connect.php';
$sql = "insert into ali_post VALUES (NULL, '$title', '待定', '$slug', '$desc', '$content', '$author', '$category', '$upfilePath', '$created', '$uptime', '$click', '$good', '$bad', '$status')";
mysql_query($sql);
$num = mysql_affected_rows($link);
if ($num > 0) {
    echo '文章添加成功';
    header("refresh: 2; url = posts.php");
} else {
    echo '文章添加失败';
    echo "<script>history.back();</script>";
}