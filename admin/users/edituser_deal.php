<?php
/**
 * Created by PhpStorm.
 * User: 小新
 * Date: 2018/1/13
 * Time: 18:44
 */
header("content-type:text/html;charset=utf8");
include_once '../common/prevent.php';
$id = $_POST['id'];
$email = trim($_POST['email']);
$slug = trim($_POST['slug']);
$nickname = trim($_POST['nickname']);
$password = md5(trim($_POST['password']));
$status = $_POST['status'];

include_once '../common/mysql_connect.php';
$sql = "update ali_user set user_email = '$email', user_slug = '$slug', user_nickname = '$nickname', user_psw = '$password', user_pic = '', user_status = $status WHERE user_id = '$id'";
mysql_query($sql);
$num = mysql_affected_rows($link);
if ($num > 0) {
    echo 1;
} else {
    echo 0;
}