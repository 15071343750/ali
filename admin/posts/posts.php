<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Posts &laquo; Admin</title>
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

$cateId = isset($_GET['cateId']) ? $_GET['cateId'] : 0;
$postState = isset($_GET['postState']) ? $_GET['postState'] : 0;
$where = '';
if ($cateId) {
    $where .= "cate_id = $cateId and ";
}
if ($postState) {
    $where .= "post_state = $postState and ";
}
$where .= 1;

// 分页
$pagesize = 3;
$countNum = mysql_query("SELECT count(post_id) as num FROM ali_post AS p
JOIN ali_user AS u on p.post_author = u.user_id
JOIN ali_cate AS c on p.post_cateid = c.cate_id WHERE $where"); // 求出当前post_id一共有几行
$pages = ceil(mysql_fetch_assoc($countNum)['num'] / $pagesize); // 总页数
$pagenum = isset($_GET['pagenum']) ? $_GET['pagenum'] : 1;
if ($pagenum < 1 || $pagenum > $pages) {
    $pagenum = 1;
}
$offset = ($pagenum - 1) * $pagesize;
// 分页

// 分页查询
$sql = "SELECT post_id, post_title, post_hot, user_nickname, cate_name, post_uptime, post_state FROM ali_post AS p
JOIN ali_user AS u on p.post_author = u.user_id
JOIN ali_cate AS c on p.post_cateid = c.cate_id WHERE $where limit $offset, $pagesize";
$res = mysql_query($sql);

?>
<div class="main">
    <?php include_once '../common/nav.php'; ?>
    <div class="container-fluid">
        <div class="page-title">
            <h1>所有文章</h1>
            <a href="addpost.php" class="btn btn-primary btn-xs">写文章</a>
        </div>
        <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
            <form class="form-inline" action="posts.php" method="get">
                <select name="cateId" class="form-control input-sm">
                    <option value="0">所有分类</option>
                    <?php
                    $cateInfo = mysql_query("select * from ali_cate");
                    while ($cateInfoRow = mysql_fetch_assoc($cateInfo)) {
                    ?>
                        <option value="<?= $cateInfoRow['cate_id']; ?>" <?= $cateId == $cateInfoRow['cate_id'] ? 'selected' : ''; ?> ><?= $cateInfoRow['cate_name']; ?></option>
                    <?php } ?>
                </select>
                <select name="postState" class="form-control input-sm">
                    <option value="0">所有状态</option>
                    <option value="1" <?= $postState == 1 ? 'selected' : ''; ?>>已发布</option>
                    <option value="2" <?= $postState == 2 ? 'selected' : ''; ?>>草稿</option>
                </select>
                <input class="btn btn-default btn-sm" type="submit" value="筛选"/>
            </form>
            <?php
            $prev = $pagenum <= 1 ? 1 : $pagenum - 1;
            $next = $pagenum >= $pages ? $pages : $pagenum + 1;
            ?>
            <ul class="pagination pagination-sm pull-right">
                <li><a href="javascript:;">总页数 <?= $pages; ?></a></li>
                <li><a href="posts.php?cateId=<?=$cateId;?>&postState=<?=$postState;?>&pagenum=1">首页</a></li>
                <li><a href="posts.php?cateId=<?=$cateId;?>&postState=<?=$postState;?>&pagenum=<?=$prev;?>">上一页</a></li>
                <?= $pagenum > 1 ? '<li><a href="javascript:;">...</a></li>' : ''; ?>
                <li><a href="javascript:;"><?= $pagenum; ?></a></li>
                <?= $pagenum < $pages ? '<li><a href="javascript:;">...</a></li>' : ''; ?>
                <li><a href="posts.php?cateId=<?=$cateId;?>&postState=<?=$postState;?>&pagenum=<?=$next;?>">下一页</a></li>
                <li><a href="posts.php?cateId=<?=$cateId;?>&postState=<?=$postState;?>&pagenum=<?=$pages;?>">尾页</a></li>
            </ul>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>标题</th><!-- post_title -->
                <th>作者</th><!-- user_nickname -->
                <th>分类</th><!-- cate_name -->
                <th class="text-center">发表时间</th><!-- post_uptime -->
                <th class="text-center">状态</th><!-- post_state -->
                <th class="text-center">推荐状态</th><!-- post_hot -->
                <th class="text-center" width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = mysql_fetch_assoc($res)) : ?>
            <tr class="tr<?=$row['post_id'];?>">
                <td class="text-center"><input type="checkbox"></td>
                <td><?= $row['post_title']; ?></td>
                <td><?= $row['user_nickname']; ?></td>
                <td><?= $row['cate_name']; ?></td>
                <td class="text-center"><?= date('Y/m/d', $row['post_uptime']); ?></td>
                <td class="text-center"><?= $row['post_state'] == 1 ? '已发布' : '草稿'; ?></td>
<!--                是否推荐栏-->
                <td class="text-center">
                    <a href="javascript:;" class="btnTj btn btn-info btn-xs <?=$row['post_state'] == 1 ? '' : 'disabled';?>" data-id="<?=$row['post_id'];?>"><?= $row['post_hot']; ?></a>
                </td>
                <td class="text-center">
                    <a href="editpost.php?postId=<?=$row['post_id'];?>&cateId=<?=$cateId;?>&postState=<?=$postState;?>" class="btn btn-default btn-xs">编辑</a>
                    <a href="javascript:;" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".bs-del-modal-sm<?=$row['post_id'];?>">删除</a>
                </td>

                <div class="modal fade bs-del-modal-sm<?=$row['post_id'];?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">删除提示:</h4>
                            </div>
                            <div class="modal-body text-center"><h3>确认删除该文章吗？</h3></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="button" class=" sure btn btn-danger" data-dismiss="modal" data-id="<?=$row['post_id'];?>">确认</button>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="aside">
    <?php include_once '../common/aside.php'; ?>
</div>

<button type="button" class="btn btn-primary hidden" data-toggle="modal" data-target=".bs-delSure-modal-sm" id="delSure">删除成功提示框</button>
<div class="modal fade bs-delSure-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center"><h3>删除成功</h3></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script src="/assets/vendors/jquery/jquery.js"></script>
<script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
<script>NProgress.done()</script>
<!--删除 ajax 实现-->
<script>
    $(".sure").click(function () {
        var id = $(this).attr("data-id");
        var className = ".tr" + id;
        $.ajax({
            url: 'delpost_deal.php',
            type: 'post',
            data: {id: id},
            dataType: 'text',
            success: function (res) {
                if (res == 1) {
                    $("#delSure").trigger('click');
                    $(className).remove();
                } else {
                    alert('删除失败');
                }
            }
        });
    });

    $(".btnTj").click(function () {
        var _this = $(this);
        var id = $(this).attr('data-id');
        var value = $(this).html();
        value = value == '推荐' ? '待定' : '推荐';
        $.ajax({
            url: 'tj_deal.php',
            data: {id: id, value: value},
            type: 'post',
            dataType: 'text',
            success: function (res) {
                if (res == 1) {
                    _this.html(value);
                } else {
                    alert('修改失败');
                }
            }
        });
    });

</script>
<script src="../common/check.js"></script>
</body>
</html>
