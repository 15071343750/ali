<?php

include_once '../common/prevent.php';
$id = $_POST['ids'];
include_once '../common/mysql_connect.php';
$sql = "delete from ali_comment WHERE cmt_id in ($id)";
mysql_query($sql);
$num = mysql_affected_rows($link);
if ($num > 0) {
    echo 1;
} else {
    echo 0;
}