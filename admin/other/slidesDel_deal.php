<?php
include_once '../common/prevent.php';

$id = $_POST['id'];
include_once '../common/mysql_connect.php';
$sql = "select pic_path from ali_pic WHERE pic_id = $id";
$res = mysql_query($sql);
$path = mysql_fetch_row($res)[0];
unlink($path);
$sql = "delete from ali_pic WHERE pic_id = $id";
mysql_query($sql);
$num = mysql_affected_rows($link);
echo $num > 0 ? 1 : 0;