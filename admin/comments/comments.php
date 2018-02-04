<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Comments &laquo; Admin</title>
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

//分页
$sql = "select COUNT(cmt_id) from ali_comment AS c 
JOIN ali_member AS m ON c.cmt_memberid = m.member_id
JOIN ali_post AS p ON c.cmt_postid = p.post_id";
$num = mysql_fetch_row(mysql_query($sql))[0];
$pagesize = 5;
$pages = ceil($num / $pagesize);
$pagenum = isset($_GET['pagenum']) ? $_GET['pagenum'] : 1;
if ($pagenum < 1 || $pagenum > $pages) {
    $pagenum = 1;
}
$offset = ($pagenum - 1) * $pagesize;
//分页

$sql = "select cmt_id, cmt_content, cmt_time, cmt_state, member_nickname, post_title from ali_comment AS c 
JOIN ali_member AS m ON c.cmt_memberid = m.member_id
JOIN ali_post AS p ON c.cmt_postid = p.post_id limit $offset, $pagesize";
$res = mysql_query($sql);

?>
<div class="main">
    <?php include_once '../common/nav.php'; ?>
    <div class="container-fluid">
        <div class="page-title">
            <h1>所有评论</h1>
        </div>
        <div class="page-action">
            <div class="btn-batch">
                <button class="btn btn-info btn-sm" id="batch_allow">批量批准</button>
                <button class="btn btn-warning btn-sm" id="batch_reject">批量驳回</button>
                <button class="btn btn-danger btn-sm" id="batch_del">批量删除</button>
<!--                <button class="btn btn-primary btn-sm" id="batch_special">相反操作</button>-->
            </div>
            <?php
            $prev = $pagenum <= 1 ? 1 : $pagenum - 1;
            $next = $pagenum >= $pages ? $pages : $pagenum + 1;
            ?>
            <ul class="pagination pagination-sm pull-right">
                <li><a href="javascript:;">总页数 <?=$pages;?></a></li>
                <li><a href="comments.php?pagenum=1">首页</a></li>
                <li><a href="comments.php?pagenum=<?=$prev;?>">上一页</a></li>
                <li><a href="javascript:;"><?=$pagenum;?></a></li>
                <li><a href="comments.php?pagenum=<?=$next;?>">下一页</a></li>
                <li><a href="comments.php?pagenum=<?=$pages;?>">尾页</a></li>
            </ul>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center" width="40"><input type="checkbox"></th>
                    <th>评论者</th>
                    <th>评论内容</th>
                    <th>评论的文章标题</th>
                    <th>提交于</th>
                    <th>状态</th>
                    <th class="text-center" width="100">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysql_fetch_assoc($res)) { ?>
                <tr class="<?= $row['cmt_state'] == '批准' ? '' : 'danger'; ?>">
                    <td class="text-center"><input type="checkbox" value="<?= $row['cmt_id']; ?>"></td>
                    <td><?= $row['member_nickname']; ?></td>
                    <td><?= $row['cmt_content']; ?></td>
                    <td><?= $row['post_title']; ?></td>
                    <td><?= date('Y/m/d', $row['cmt_time']); ?></td>
                    <td class="state"><?= $row['cmt_state']; ?></td>
                    <td class="text-center">
                        <a href="javascript:;" data-id="<?= $row['cmt_id']; ?>" class="btncmt btn btn-xs <?= $row['cmt_state'] == '批准' ? 'btn-warning' : 'btn-info'; ?>"><?= $row['cmt_state'] == '批准' ? '驳回' : '批准'; ?></a>
                        <a href="javascript:;" data-id="<?= $row['cmt_id']; ?>" class="btndel btn btn-danger btn-xs">删除</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="aside">
    <?php include_once '../common/aside.php'; ?>
</div>

<button type="button" id="operation" class="btn btn-primary hidden" data-toggle="modal" data-target=".bs-operation-modal">操作成功提示框</button>
<div class="modal fade bs-operation-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center"><h3>操作成功</h3></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script src="/assets/vendors/jquery/jquery.js"></script>
<script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
<script>NProgress.done()</script>
<script>
//    批准、驳回
    $(".btncmt").click(function () {
        var thisBtn =  $(this);
        var btnValue = $(this).html();  // 按钮上面原有的文字
        var tr = $(this).parent().parent();
        var thisState = $(this).parent().parent().find('.state');
        var thisStateValue = thisState.html();  // td状态栏中原有的文字
        $.ajax({
            url: 'oper_deal.php',
            data: {
                id: thisBtn.attr('data-id'),
                btnValue: btnValue
            },
            type: 'post',
            dataType: 'text',
            success: function (res) {
                if (res == 1) {
                    thisBtn.html(thisStateValue);
                    thisState.html(btnValue);
                    if (thisBtn.hasClass('btn-info')) {
                        thisBtn.removeClass('btn-info').addClass('btn-warning');
//                        如果原来按钮有 btn-info 类名，当前 tr 就有 danger
                        tr.removeClass('danger');
                    } else {
                        thisBtn.removeClass('btn-warning').addClass('btn-info');
                        tr.addClass('danger');
                    }
                    $("#operation").trigger('click');
                } else {
                    alert('修改失败');
                }
            }
        });
    });

//    删除
    $(".btndel").click(function () {
        var that = $(this);
        $.ajax({
            url: 'del_deal.php',
            data: {ids: that.attr('data-id')},
            type: 'post',
            dataType: 'text',
            success: function (res) {
                if (res == 1) {
                    that.parent().parent().remove();
                    $("#operation").trigger('click');
                } else {
                    alert('删除失败');
                }
            }
        });
    });

//    会有性能问题，需要发送多次ajax请求
    $("#batch_special").click(function () {
        var checked_list = $(":checkbox:checked");
        checked_list.each(function (index, ele) {
            $(ele).parent().parent().find('.btncmt').trigger('click');
        });
//        $(":checkbox:checked").parent().parent().find('td:last').find('a:first').trigger('click');
        $(":checkbox:checked").removeAttr('checked');
    });

//    批量批准
    $("#batch_allow").click(function () {
        var checked_list = $("tbody :checkbox:checked");
        var str = '';
        checked_list.each(function (index, ele) {
            str += ele.value + ",";
        });
        str = str.substr(0, str.length - 1);
        $.ajax({
            url: 'allow_deal.php',
            data: {ids: str},
            type: 'post',
            dataType: 'text',
            success: function (res) {
                if (res == 1) {
                    checked_list.each(function () {
                        var target = $(this).parent().parent();
                        target.removeClass('danger');
                        target.find('.state').html('批准');
                        target.find('.btncmt').html('驳回').removeClass('btn-info').addClass('btn-warning');
                    });
                    $("#operation").trigger('click');
                    $(":checkbox:checked").removeAttr('checked');
                } else {
                    alert('批量批准失败');
                }
            }
        });
    });

//    批量驳回
    $("#batch_reject").click(function () {
        var checked_list = $("tbody :checkbox:checked");
        var str = '';
        checked_list.each(function (index, ele) {
            str += ele.value + ",";
        });
        str = str.substr(0, str.length - 1);
        $.ajax({
            url: 'reject_deal.php',
            data: {ids: str},
            type: 'post',
            dataType: 'text',
            success: function (res) {
                if (res == 1) {
                    checked_list.each(function () {
                        var target = $(this).parent().parent();
                        target.addClass('danger');
                        target.find('.state').html('驳回');
                        target.find('.btncmt').html('批准').removeClass('btn-warning').addClass('btn-info');
                    });
                    $("#operation").trigger('click');
                    $(":checkbox:checked").removeAttr('checked');
                } else {
                    alert('批量驳回失败');
                }
            }
        });
    });

//    批量删除
    $("#batch_del").click(function () {
        var checked_list = $("tbody :checkbox:checked");
        var str = '';
        checked_list.each(function (index, ele) {
            str += ele.value + ",";
        });
        str = str.substr(0, str.length - 1);
        $.ajax({
            url: 'del_deal.php',
            data: {ids: str},
            type: 'post',
            dataType: 'text',
            success: function (res) {
                if (res == 1) {
                    checked_list.each(function () {
                        $(this).parent().parent().remove();
                    });
                    $(":checkbox:checked").removeAttr('checked');
                    $("#operation").trigger('click');
                } else {
                    alert('批量删除失败');
                }
            }
        });
    });

</script>
<script src="../common/check.js"></script>
</body>
</html>
