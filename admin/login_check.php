<?php
/**
 * Created by PhpStorm.
 * User: 小新
 * Date: 2018/1/15
 * Time: 15:07
 */
$code = $_POST['code'];
session_start();
if ($_SESSION['code'] != $code) {
    echo 0;
    header("refresh: 1; url = login.html");
    die();
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);
include_once 'common/mysql_connect.php';
$sql = "select * from ali_user WHERE user_email = '$email'";
$res = mysql_query($sql);
$row = mysql_fetch_assoc($res);
$user_psw = $row['user_psw'];
$user_id = $row['user_id'];
if (md5($password) == $user_psw) {
    $_SESSION['userInfo'] = $user_psw;
    $_SESSION['userId'] = $user_id;
    header("location: other/index.php");
} else {
    echo '密码错误';
    header("refresh: 2; url = login.html");
}