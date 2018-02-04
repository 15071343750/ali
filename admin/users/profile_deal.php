<?php
header("content-type:text/html;charset=utf8");
include_once '../common/prevent.php';
include_once '../common/mysql_connect.php';
$id = $_SESSION['userId'];
$slug = trim($_POST['slug']);
$nickname = trim($_POST['nickname']);

$picPathRes = mysql_query("select user_pic from ali_user WHERE user_id = $id");
$oldPath = mysql_fetch_row($picPathRes)[0]; // 默认
$imgPath = '';
if ($_FILES['avatar']['error'] == 0) {
    $ext = strrchr($_FILES['avatar']['name'], '.');
    $imgPath = '../uploads/' . 'h' . date('YmdHis-') . mt_rand(100, 999) . $ext;
    move_uploaded_file($_FILES['avatar']['tmp_name'], $imgPath);
}
if ($imgPath) {
    unlink($oldPath);
} else {
    $imgPath = $oldPath;
}

mysql_query("update ali_user set user_slug = '$slug', user_nickname = '$nickname', user_pic = '$imgPath' WHERE user_id = $id");
$num = mysql_affected_rows($link);
if ($num > 0) {
    echo '更新成功';
    header("refresh: 2; url = profile.php");
} else {
    echo '更新失败';
    sleep(2);
    echo "<script>history.back();</script>";
}