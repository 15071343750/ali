<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Dashboard &laquo; Admin</title>
    <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<script>NProgress.start()</script>
<?php
include_once '../common/prevent.php';
include_once '../common/mysql_connect.php';
$id = $_SESSION['userId'];
$res = mysql_query("select * from ali_user WHERE user_id = $id");
$row = mysql_fetch_assoc($res);
?>
<div class="main">
    <?php include_once '../common/nav.php'; ?>
    <div class="container-fluid">
        <div class="page-title">
            <h1>我的个人资料</h1>
        </div>
        <form class="form-horizontal" action="profile_deal.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-3 control-label">头像</label>
                <div class="col-sm-6">
                    <label class="form-image">
                        <input id="avatar" type="file" name="avatar">
<!--                    $row['user_pic']  ../uploads/h20180117093233-513.jpg  -->
                        <img src="<?= $row['user_pic'] ? "/admin" . strchr($row['user_pic'], '/') : '/assets/img/default.png';?>" id="imgShow">
                        <i class="mask fa fa-upload"></i>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">邮箱</label>
                <div class="col-sm-6">
                    <input id="email" class="form-control" name="email" type="type" value="<?=$row['user_email'];?>" readonly>
                    <p class="help-block">登录邮箱不允许修改</p>
                </div>
            </div>
            <div class="form-group">
                <label for="slug" class="col-sm-3 control-label">别名</label>
                <div class="col-sm-6">
                    <input id="slug" class="form-control" name="slug" type="type" value="<?=$row['user_slug'];?>">
                    <p class="help-block">https://zce.me/author/<strong>zce</strong></p>
                </div>
            </div>
            <div class="form-group">
                <label for="nickname" class="col-sm-3 control-label">昵称</label>
                <div class="col-sm-6">
                    <input id="nickname" class="form-control" name="nickname" type="type" value="<?=$row['user_nickname'];?>">
                    <p class="help-block">限制在 2-16 个字符</p>
                </div>
            </div>
<!--            <div class="form-group">-->
<!--                <label for="bio" class="col-sm-3 control-label">简介</label>-->
<!--                <div class="col-sm-6">-->
<!--                    <textarea id="bio" class="form-control" placeholder="Bio" cols="30"-->
<!--                              rows="6">MAKE IT BETTER!</textarea>-->
<!--                </div>-->
<!--            </div>-->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">更新</button>
                    <a class="btn btn-link" href="psw_reset.php">修改密码</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="aside">
    <?php include_once '../common/aside.php'; ?>
</div>

<script src="/assets/vendors/jquery/jquery.js"></script>
<script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
<script>NProgress.done()</script>
<!--上传头像在本页面显示-->
<script>
    var avatar = document.getElementById('avatar');
    avatar.onchange = function () {
        var fileURL = avatar.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(fileURL);
        reader.onload = function () {
            document.getElementById('imgShow').src = this.result;
        }
    }
</script>
</body>
</html>
