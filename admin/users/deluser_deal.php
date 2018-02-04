<?php
/**
 * Created by PhpStorm.
 * User: 小新
 * Date: 2018/1/13
 * Time: 16:24
 */
header("content-type:text/html;charset=utf8");
include_once '../common/prevent.php';
$id = $_POST['id'];
include_once "../common/mysql_connect.php";
$sql = "delete from ali_user WHERE user_id = $id";
mysql_query($sql);
$num = mysql_affected_rows($link);
echo $num > 0 ? 1 : 0;