<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Users &laquo; Admin</title>
    <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<script>NProgress.start()</script>
<?php include_once '../common/prevent.php'; ?>
<?php
include_once "../common/mysql_connect.php";
$id = $_GET['id'];
$sql = "select * from ali_user WHERE user_id = $id";
$res = mysql_query($sql);
$info = mysql_fetch_assoc($res);
?>
<div class="main">
    <?php include_once '../common/nav.php'; ?>
    <div class="container-fluid">
        <div class="page-title">
            <h1>用户</h1>
        </div>
        <div class="row">
            <div class="col-md-5">
                <form action="" method="">
                    <h2>修改用户</h2>
                    <input id="user_id" type="hidden" name="id" value="<?= $info['user_id']; ?>">
                    <div class="form-group">
                        <label for="email">邮箱</label>
                        <input id="email" class="form-control" name="email" type="email" value="<?= $info['user_email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="slug">别名</label>
                        <input id="slug" class="form-control" name="slug" type="text" value="<?= $info['user_slug']; ?>">
                        <p class="help-block">https://zce.me/author/<strong>slug</strong></p>
                    </div>
                    <div class="form-group">
                        <label for="nickname">昵称</label>
                        <input id="nickname" class="form-control" name="nickname" type="text" value="<?= $info['user_nickname']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">密码</label>
                        <input id="password" class="form-control" name="password" type="text" placeholder="我不会把md5加密的密码转回来所以..请重新设置密码^_^">
                    </div>
                    <div class="form-group">
                        <label for="status">状态</label>
                        <input name="status" type="radio" <?= $info['user_status'] == 1 ? 'checked' : ''; ?> value="1">激活
                        <input name="status" type="radio" <?= $info['user_status'] == 0 ? 'checked' : ''; ?> value="0">禁用
                    </div>
                    <div class="form-group">
                        <input type="button" value="修改" class="btn btn-primary" id="edit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="aside">
    <?php include_once "../common/aside.php"; ?>
</div>

<button type="button" id="editSucc" class="btn btn-primary hidden" data-toggle="modal" data-target=".bs-editSucc-modal-sm">修改成功提示框</button>
<div class="modal fade bs-editSucc-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">修改成功</div>
            <div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal" id="editSuccBtn">OK</button></div>
        </div>
    </div>
</div>

<button type="button" id="editFail" class="btn btn-primary hidden" data-toggle="modal" data-target=".bs-editFail-modal-sm">AJAX未执行提示框</button>
<div class="modal fade bs-editFail-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">修改失败</div>
            <div class="modal-body text-center" id="failWhy"></div>
            <div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">OK</button></div>
        </div>
    </div>
</div>

<script src="/assets/vendors/jquery/jquery.js"></script>
<script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
<script>NProgress.done()</script>
<script>
    $("#edit").click(function () {
        var id = $.trim($("#user_id").val());
        var email = $.trim($("#email").val());
        var slug = $.trim($("#slug").val());
        var nickname = $.trim($("#nickname").val());
        var password = $.trim($("#password").val());
        var status = $("input[type='radio']:checked").val();
        var arr = [];
        arr.push(email == '' ? '邮箱' : '');
        arr.push(slug == '' ? '别名' : '');
        arr.push(nickname == '' ? '昵称' : '');
        arr.push(password == '' ? '密码' : '');
        $("#failWhy").html(arr.join().replace(/[，,]/g, '') + "不能为空！");
        if (email == '' || slug == '' || nickname == '' || password == '') {
            $("#editFail").trigger('click');
            return;
        }
        $.ajax({
            type: 'post',
            url: 'edituser_deal.php',
            data: {
                id: id,
                email: email,
                slug: slug,
                nickname: nickname,
                password: password,
                status: status
            },
            dataType: 'text',
            success: function (res) {
                if (res == 1) {     // 修改成功
                    $("#editSucc").trigger('click');
//                    editSuccBtn 按钮不点击仍然可以跳转
                    $("#editSuccBtn").click(function () {
                        $(location).attr('href', 'users.php');
                    });
                } else {
                    alert('修改失败');
                }
            }
        });
    });
</script>
</body>
</html>
