<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Add new post &laquo; Admin</title>
    <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <script src="/assets/vendors/nprogress/nprogress.js"></script>

<!--    富文本插件-->
    <link type="text/css" rel="stylesheet" href="/assets/Umeditor/themes/default/css/umeditor.min.css">
    <script type="text/javascript" src="/assets/Umeditor/third-party/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/assets/Umeditor/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/assets/Umeditor/umeditor.min.js"></script>
    <script type="text/javascript" src="/assets/Umeditor/lang/zh-cn/zh-cn.js"></script>

</head>
<body>
<script>NProgress.start()</script>
<?php include_once '../common/prevent.php'; ?>
<div class="main">
    <?php include_once '../common/nav.php'; ?>
    <div class="container-fluid">
        <div class="page-title">
            <h1>写文章</h1>
        </div>
        <form class="row" action="addpost_deal.php" method="post" enctype="multipart/form-data">
            <div class="col-md-9">
                <div class="form-group">
                    <label for="title">标题</label>
                    <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
                </div>
                <div class="form-group">
                    <label for="content">内容</label>
                    <textarea name="content" id="content" style="width: 100%;"></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="slug">别名</label>
                    <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
                    <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
                </div>
                <div class="form-group">
                    <label for="feature">特色图像</label>
                    <!-- show when image chose -->
                    <img class="help-block thumbnail" style="display: none">
                    <input id="feature" class="form-control" name="feature" type="file">
                </div>
                <div class="form-group">
                    <label for="category">所属分类</label>
                    <select id="category" class="form-control" name="category">
                        <option value="0">--请选择--</option>
                        <?php
                            include_once '../common/mysql_connect.php';
                            $res = mysql_query("select * from ali_cate where cate_status = 1");
                            while ($row = mysql_fetch_assoc($res)) {
                        ?>
                        <option value="<?= $row['cate_id']; ?>"><?= $row['cate_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="created">发布时间</label>
                    <input id="created" class="form-control" name="created" type="datetime-local">
                </div>
                <div class="form-group">
                    <label for="status">状态</label>
                    <select id="status" class="form-control" name="status">
                        <option value="2">草稿</option>
                        <option value="1">已发布</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">保存</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="aside">
    <?php include_once '../common/aside.php'; ?>
</div>

<button type="button" id="reminder" class="btn btn-primary hidden" data-toggle="modal" data-target=".bs-reminder-modal-sm"></button>
<div class="modal fade bs-reminder-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">非法添加</h3>
            </div>
            <div class="modal-body">
                <h4 id="reminderInfo" class="text-center"></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
<script>NProgress.done()</script>
<script>
    // 实例化编辑器
    var um = UM.getEditor('content', {
        initialContent: '文章内容',
//        initialFrameWidth: 500,      // 初始化编辑器宽度,默认500
        initialFrameHeight: 260     // 初始化编辑器高度,默认500
    });

//    初步判断，为空时不允许提交
    $("button:submit").click(function () {
        if ($("#title").val() == '' || $("#slug").val() == '' || $("#category").val() == 0 || $("#created").val() == '') {
            var reminderArr = [];
            if ($("#title").val() == '') {
                reminderArr.push('标题');
            }
            if ($("#slug").val() == '') {
                reminderArr.push('别名');
            }
            if ($("#category").val() == 0) {
                reminderArr.push('分类');
            }
            if ($("#created").val() == '') {
                reminderArr.push('时间');
            }
            var strInfo = reminderArr.join('、');
            $("#reminderInfo").html("请输入" + strInfo);
            $("#reminder").trigger('click');
            return false;
        }
    });

</script>
</body>
</html>
