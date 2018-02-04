<?php
include_once '../common/prevent.php';

$id = $_POST['id'];
$value = $_POST['value'];

include_once '../common/mysql_connect.php';
$sql = "update ali_pic set pic_state = '$value' WHERE pic_id = $id";
mysql_query($sql);
$num = mysql_affected_rows($link);
echo $num > 0 ? 1 : 0;