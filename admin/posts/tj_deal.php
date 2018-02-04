<?php
// 推荐状态修改
include_once '../common/prevent.php';
$id = $_POST['id'];
$value = $_POST['value'];
include_once '../common/mysql_connect.php';
mysql_query("update ali_post set post_hot = '$value' WHERE post_id = $id");
$num = mysql_affected_rows($link);
echo $num > 0 ? 1 : 0;