<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Password reset &laquo; Admin</title>
    <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<script>NProgress.start()</script>
<?php include_once '../common/prevent.php'; ?>
<div class="main">
    <?php include_once '../common/nav.php'; ?>
    <div class="container-fluid">
        <div class="page-title">
            <h1>修改密码</h1>
        </div>
        <form class="form-horizontal" method="post" action="psw_reset_deal.php">
            <div class="form-group">
                <label for="old" class="col-sm-3 control-label">旧密码</label>
                <div class="col-sm-7">
                    <input id="old" name="oldpsw" class="form-control" type="password" placeholder="旧密码">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-3 control-label">新密码</label>
                <div class="col-sm-7">
                    <input id="password" name="newpsw" class="form-control" type="password" placeholder="新密码">
                </div>
            </div>
            <div class="form-group">
                <label for="confirm" class="col-sm-3 control-label">确认新密码</label>
                <div class="col-sm-7">
                    <input id="confirm" name="rNewpsw" class="form-control" type="password" placeholder="确认新密码">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-7">
                    <button type="submit" class="btn btn-primary">修改密码</button>
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
</body>
</html>
