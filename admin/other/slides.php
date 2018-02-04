<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Slides &laquo; Admin</title>
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
$sql = "select * from ali_pic";
$res = mysql_query($sql);
?>
<div class="main">
    <?php include_once '../common/nav.php'; ?>
    <div class="container-fluid">
        <div class="page-title">
            <h1>图片轮播</h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                <form action="slidesAdd_deal.php" method="post" enctype="multipart/form-data">
                    <h2>添加新轮播内容</h2>
                    <div class="form-group">
                        <label for="image">图片</label>
                        <!-- show when image chose -->
                        <img class="help-block thumbnail" style="display: none">
                        <input id="image" class="form-control" name="image" type="file">
                    </div>
                    <div class="form-group">
                        <label for="text">文本</label>
                        <input id="text" class="form-control" name="text" type="text" placeholder="文本">
                    </div>
                    <div class="form-group">
                        <label for="link">链接</label>
                        <input id="link" class="form-control" name="link" type="text" value="#">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">添加</button>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div class="page-action">
                    <!-- show when multiple checked -->
                    <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" width="40"><input type="checkbox"></th>
                        <th class="text-center">图片</th>
                        <th>文本</th>
                        <th>显示状态</th>
                        <th class="text-center" width="100">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysql_fetch_assoc($res)) { ?>
                    <tr>
                        <td class="text-center"><input type="checkbox"></td>
                        <td class="text-center"><img class="slide" src="<?=$row['pic_path'];?>"></td>
                        <td><?=$row['pic_txt'];?></td>
                        <td class="state"><?=$row['pic_state'];?></td>
                        <td class="text-center">
                            <a href="javascript:;" data-id="<?=$row['pic_id'];?>" class="btnCShow btn btn-xs <?=$row['pic_state'] == '显示' ? 'btn-warning' : 'btn-info';?>"><?=$row['pic_state'] == '显示' ? '隐藏' : '显示';?></a>
                            <a href="javascript:;" data-id="<?=$row['pic_id'];?>" class="btnDel btn btn-danger btn-xs">删除</a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="aside">
    <?php include_once '../common/aside.php'; ?>
</div>

<script src="../../assets/vendors/jquery/jquery.js"></script>
<script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
<script>NProgress.done()</script>
<script>
    $(".btnCShow").click(function () {
        var _this = $(this);
        var id = $(this).attr('data-id');
        var btnValue = $(this).html(); // 按钮上面原有的文字
        var state = $(this).parent().parent().find('.state');
        var stateValue = state.html();
        $.ajax({
            url: 'slidesState_deal.php',
            data: {
                id: id,
                value: btnValue
            },
            type: 'post',
            dataType: 'text',
            success: function (res) {
                if (res == 1 ) {
                    _this.html(stateValue);
                    state.html(btnValue);
                    if (_this.hasClass('btn-info')) {
                        _this.removeClass('btn-info').addClass('btn-warning');
                    } else {
                        _this.removeClass('btn-warning').addClass('btn-info');
                    }
                } else {
                    alert('状态修改失败');
                }
            }
        });
    });
    $(".btnDel").click(function () {
        var _this = $(this);
        var id = $(this).attr('data-id');
        $.ajax({
            url: 'slidesDel_deal.php',
            data: {id: id},
            type: 'post',
            dataType: 'text',
            success: function (res) {
               if (res == 1) {
                   _this.parent().parent().remove();
               } else {
                   alert('删除失败');
               }
            }
        });
    });
</script>
<script src="../common/check.js"></script>
</body>
</html>
