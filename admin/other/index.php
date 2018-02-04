<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Dashboard &laquo; Admin</title>
    <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<script>NProgress.start()</script>
<?php
include_once '../common/prevent.php';
include_once '../common/mysql_connect.php';

//文章总数
$wzSql = "select count(post_id) from ali_post";
$wzRes = mysql_query($wzSql);
//草稿总数
$cgSql = "select count(post_id) from ali_post WHERE post_state = 2";
$cgRes = mysql_query($cgSql);
//分类总数
$flSql = "select count(cate_id) from ali_cate";
$flRes = mysql_query($flSql);
$flSql2 = "select count(cate_id) from ali_cate WHERE cate_show != 1";
$flRes2 = mysql_query($flSql2);
//评论总数
$plSql = "select count(cmt_id) from ali_comment";
$plRes = mysql_query($plSql);
//待审核评论
$dshSql = "select count(cmt_id) from ali_comment WHERE cmt_state = '驳回'";
$dshRes = mysql_query($dshSql);
?>
<div class="main">
    <?php include_once '../common/nav.php'; ?>
    <div class="container-fluid">
        <div class="jumbotron text-center">
            <h1>One Belt, One Road</h1>
            <p>Thoughts, stories and ideas.</p>
            <p><a class="btn btn-primary btn-lg" href="../posts/addpost.php" role="button">写文章</a></p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">站点内容统计：</h3>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><strong><?=mysql_fetch_row($wzRes)[0];?></strong>篇文章（<strong><?=mysql_fetch_row($cgRes)[0];?></strong>篇草稿）</li>
                        <li class="list-group-item"><strong><?=mysql_fetch_row($flRes)[0];?></strong>个分类（<strong><?=mysql_fetch_row($flRes2)[0];?></strong>个隐藏）</li>
                        <li class="list-group-item"><strong><?=mysql_fetch_row($plRes)[0];?></strong>条评论（<strong><?=mysql_fetch_row($dshRes)[0];?></strong>条待审核）</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>

<div class="aside">
    <?php include_once '../common/aside.php'; ?>
</div>

<script src="../../assets/vendors/jquery/jquery.js"></script>
<script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
<script>NProgress.done()</script>
<script src="../common/check.js"></script>
</body>
</html>
