<?php
/**
 * Created by PhpStorm.
 * User: 小新
 * Date: 2018/1/13
 * Time: 14:50
 */
header("content-type:text/html;charset=utf8");
include_once '../common/prevent.php';
$email = trim($_POST['email']);
$slug = trim($_POST['slug']);
$nickname = trim($_POST['nickname']);
$password = md5(trim($_POST['password']));
$status = trim($_POST['status']);
include_once '../common/mysql_connect.php';
$sql = "insert into ali_user VALUES (null, '$email', '$slug', '$nickname', '$password', '', '$status')";
mysql_query($sql);
$num = mysql_affected_rows($link);
if ($num > 0) {
    echo "添加成功";
    header("refresh: 2; url = users.php");
} else {
    echo "添加失败";
    header("refresh: 2; url = adduser.php");
}