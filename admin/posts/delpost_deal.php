<?php
include_once "../common/prevent.php";
include_once "../common/mysql_connect.php";

$id = $_POST['id'];
$sql = "delete from ali_post WHERE post_id = $id";
mysql_query($sql);
$num = mysql_affected_rows($link);
echo $num > 0 ? 1 : 0;