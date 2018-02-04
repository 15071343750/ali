<?php
include_once '../common/prevent.php';

$id = $_POST['id'];
$btnValue = $_POST['btnValue'];
include_once '../common/mysql_connect.php';
$sql = "update ali_comment set cmt_state = '$btnValue' WHERE cmt_id = $id";
mysql_query($sql);
$num = mysql_affected_rows($link);
if ($num > 0) {
    echo 1;
} else {
    echo 2;
}