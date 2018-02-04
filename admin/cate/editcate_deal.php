<?php
/**
 * Created by PhpStorm.
 * User: 小新
 * Date: 2018/1/12
 * Time: 19:46
 */
header("content-type:text/html;charset=utf8");
include_once '../common/prevent.php';
$id = $_POST['id'];
$name = trim($_POST['name']);
$slug = trim($_POST['slug']);
$icon = trim($_POST['icon']);
$status = trim($_POST['status']);
$show = trim($_POST['show']);
include_once '../common/mysql_connect.php';
$sql = "update ali_cate set cate_name = '$name', cate_slug = '$slug', cate_class = '$icon', cate_status = '$status', cate_show = '$show' WHERE cate_id = '$id'";
mysql_query($sql);
$num = mysql_affected_rows($link);
if ($num > 0) {
    echo '修改成功';
    header("refresh: 2; url = 'categories.php'");
} else {
    echo '修改失败';
    header("refresh: 2; url = editcate.php?id=" . $id);
}

?>