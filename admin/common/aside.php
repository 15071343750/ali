<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<!--路径都是用绝对路径-->
<?php
include_once 'prevent.php';
include_once 'mysql_connect.php';
$id = $_SESSION['userId'];
$res = mysql_query("select * from ali_user WHERE user_id = $id");
$row = mysql_fetch_assoc($res);
?>
<div class="profile">
    <img class="avatar" src="<?= $row['user_pic'] ? "/admin" . strchr($row['user_pic'], '/') : '/assets/img/default.png';?>">
    <h3 class="name"><?=$row['user_nickname'];?></h3>
</div>
<ul class="nav">
    <li>
        <a href="/admin/other/index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
    </li>
    <li class="active">
        <a href="#menu-posts" data-toggle="collapse">
            <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse in">
            <li><a href="/admin/posts/posts.php">所有文章</a></li>
            <li><a href="/admin/posts/addpost.php">写文章</a></li>
            <li class="active"><a href="/admin/cate/categories.php">分类目录</a></li>
        </ul>
    </li>
    <li>
        <a href="/admin/comments/comments.php"><i class="fa fa-comments"></i>评论</a>
    </li>
    <li>
        <a href="/admin/users/users.php"><i class="fa fa-users"></i>用户</a>
    </li>
    <li>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
            <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse">
            <li><a href="../other/slides.php">图片轮播</a></li>
            <li><a href="../other/settings.php">网站设置</a></li>
        </ul>
    </li>
</ul>
</body>
</html>