<?php
header("content-type:text/html;charset=utf8");
include_once "../common/mysql_connect.php";
include_once '../common/prevent.php';
/**
 * Created by PhpStorm.
 * User: 小新
 * Date: 2018/1/12
 * Time: 16:11
 */
$name = trim($_POST['name']);
$slug = trim($_POST['slug']);
$icon = trim($_POST['icon']);
$status = trim($_POST['status']);
$show = trim($_POST['show']);

$sql = "insert into ali_cate VALUES (null, '$name', '$slug', '$icon', $status, $show)";
mysql_query($sql);

//获取执行sql之后返回的影响行数
$num = mysql_affected_rows($link);

if ($num > 0) {
    echo '分类添加成功';
    header("refresh: 2; url = 'categories.php'");
} else {
    echo '分类添加失败';
    header("refresh: 2; url = 'addcate.php'");
}

?>