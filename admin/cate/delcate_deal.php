<?php
/**
 * Created by PhpStorm.
 * User: 小新
 * Date: 2018/1/12
 * Time: 17:17
 */
header("content-type:text/html;charset=utf8");
include_once '../common/prevent.php';
include_once '../common/mysql_connect.php';
$id = $_GET['id'];
$sql = "delete from ali_cate WHERE cate_id = '$id'";
// delete from ali_cate WHERE cate_id = '1'
mysql_query($sql);

$num = mysql_affected_rows($link);
if ($num > 0) {
    echo '删除成功';
    header("refresh: 2; url = 'categories.php'");
} else {
    echo '删除失败';
    header("refresh: 2; url = 'categories.php'");
}

?>