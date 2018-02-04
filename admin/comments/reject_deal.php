<?php
include_once '../common/prevent.php';
$ids = $_POST['ids'];
$sql = "update ali_comment set cmt_state = '驳回' WHERE cmt_id in ($ids)";
include_once '../common/mysql_connect.php';
mysql_query($sql);
$num = mysql_affected_rows($link);
if ($num > 0) {
    echo 1;
} else {
    echo 0;
}