<?php
header("content-type:text/html;charset=utf8");
include_once '../common/prevent.php';
include_once '../common/mysql_connect.php';
$title = trim($_POST['title']);
$content = trim($_POST['content']);
$slug = trim($_POST['slug']);
$category = trim($_POST['category']);
//$uptime = strtotime($_POST['created']);
$uptime = time();
$status = trim($_POST['status']);

//$cateId = isset($_POST['cateId']) ? $_POST['cateId'] : 0;
//$postState = isset($_POST['postState']) ? $_POST['postState'] : 0;
//$postId = isset($_POST['postId']) ? $_POST['postId'] : 1;

$cateId = $_POST['cateId'];
$postState = $_POST['postState'];
$postId = $_POST['postId'];

$resP = mysql_query("select post_file from ali_post WHERE post_id = $postId");
$oldPath = mysql_fetch_row($resP)[0];    // 原有文件路径
if ($_FILES['feature']['error'] == 0) {
    $ext = strrchr($_FILES['feature']['name'], '.');
    $upfilePath = "../uploads/" . time() . mt_rand(100, 999) . $ext;
    move_uploaded_file($_FILES['feature']['tmp_name'], $upfilePath);
    @unlink($oldPath);   // 删除图片
} else {
    $upfilePath = $oldPath;
}

$sql = "update ali_post set post_title = '$title', post_content = '$content', post_slug = '$slug', post_cateid = '$category', post_uptime = '$uptime', post_state = '$status', post_file = '$upfilePath' WHERE post_id = $postId";
mysql_query($sql);
$num = mysql_affected_rows($link);
if ($num > 0) {
    echo '文章修改成功';
    header("refresh: 2; url = posts.php?cateId=" . $cateId . "&postState=" . $postState);
} else {
    echo "文章修改失败";
    header("refresh: 2; url = posts.php?cateId=" . $cateId . "&postState=" . $postState . "&postId=" . $postId);
}