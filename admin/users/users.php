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
include_once '../common/mysql_connect.php';
$pagesize = 3;  // 分页 每一页的数据条数

// 计算总页数 $pages
$res = mysql_query("select count(*) as num from ali_user");
$pages = ceil(mysql_fetch_assoc($res)['num'] / $pagesize);

$pagenum = isset($_GET['pagenum'])? $_GET['pagenum'] : 1;
if ($pagenum > $pages || $pagenum < 1) {
    $pagenum = 1;
}
$offset = ($pagenum - 1) * $pagesize;
$sql = "select * from ali_user limit $offset, $pagesize";
$res = mysql_query($sql);
?>
<div class="main">
    <?php include_once '../common/nav.php'; ?>
    <div class="container-fluid">
        <div class="page-title">
            <h1>用户</h1>
            <a href="adduser.php">添加新用户</a>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="page-action">
                    <!-- show when multiple checked -->
                    <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" width="40"><input type="checkbox"></th>
                        <th class="text-center" width="80">头像</th>
                        <th>邮箱</th>
                        <th>别名</th>
                        <th>昵称</th>
                        <th>状态</th>
                        <th class="text-center" width="100">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysql_fetch_assoc($res)) { ?>
<!--                        每个tr都有唯一class类名-->
                    <tr class="tr<?= $row['user_id'];?>">
                        <td class="text-center"><input type="checkbox"></td>
                        <td class="text-center"><img class="avatar" src="<?= $row['user_pic']; ?>"></td>
                        <td><?= $row['user_email']; ?></td>
                        <td><?= $row['user_slug']; ?></td>
                        <td><?= $row['user_nickname']; ?></td>
                        <td><?php echo $row['user_status'] == 1 ? '激活' : '禁用'; ?></td>
                        <td class="text-center">
                            <a href="edituser.php?id=<?= $row['user_id'];?>" class="btn btn-default btn-xs">编辑</a>
<!--                            也可以通过a链接做按钮来实现-->
                            <input type="button" value="删除" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".bs-del-modal-sm<?= $row['user_id']; ?>">
                        </td>
<!--                        是否确认删除框 每一个tr中的删除按钮都对应一个删除框 -->
                        <div class="modal fade bs-del-modal-sm<?= $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">删除提示</h4>
                                    </div>
                                    <div class="modal-body text-center">确定删除该用户吗？</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                        <button type="button" class="sure btn btn-danger" data-dismiss="modal" data-id="<?= $row['user_id']; ?>">确认</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <ul class="pagination pagination-sm pull-right">
                    <li><a href="javascript:;">总页数 <?= $pages; ?></a></li>
                    <li><a href="users.php?pagenum=1">首页</a></li>
                    <?php
                    $prev = $pagenum <= 1 ? 1 : $pagenum - 1;
                    $next = $pagenum >= $pages ? $pages : $pagenum + 1;
                    ?>
                    <li><a href="users.php?pagenum=<?= $prev; ?>">上一页</a></li>
<!--                    第一种：把所有页都显示出来 -->
<!--                    --><?php //for ($i = 1; $i <= $pages; $i++) { ?>
<!--                        <li><a href="users.php?pagenum=--><?//= $i; ?><!--">--><?//= $i; ?><!--</a></li>-->
<!--                    --><?php //} ?>
<!--                    第二种：只显示当前页 -->
                    <?= $pagenum > 1 ? "<li><a href='javascript:;'>...</a></li>" : ""; ?>
                    <li><a href="users.php?pagenum=<?= $pagenum; ?>"><?= $pagenum; ?></a></li>
                    <?= $pagenum < $pages ? "<li><a href='javascript:;'>...</a></li>" : ""; ?>
                    <li><a href="users.php?pagenum=<?= $next; ?>">下一页</a></li>
                    <li><a href="users.php?pagenum=<?= $pages; ?>">尾页</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!--左边固定栏-->
<div class="aside">
    <?php include_once '../common/aside.php'; ?>
</div>

<!--删除成功提示框-->
<button type="button" id="delSure" class="btn btn-primary hidden" data-toggle="modal" data-target=".bs-delSure-modal-sm">删除成功提示框</button>
<div class="modal fade bs-delSure-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">删除成功</div>
            <div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">OK</button></div>
        </div>
    </div>
</div>

<script src="/assets/vendors/jquery/jquery.js"></script>
<script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
<script>NProgress.done()</script>
<script>
//    删除事件
    $(".sure").click(function () {
        var userId = $(this).attr('data-id');
//        获取当前要删除的tr的class类名
        var className = ".tr" + userId;
        $.ajax({
            url: 'deluser_deal.php',
            type: 'post',
            data: { id: userId },
            dataType: 'text',
            success: function (res) {
                if (res == 1) {
//                    $("#delSure").click();
                    $("#delSure").trigger("click");
                    $(className).remove();
                } else {
                    alert("删除失败");
                }
            }
        });
    });
</script>
<script src="../common/check.js"></script>
</body>
</html>
