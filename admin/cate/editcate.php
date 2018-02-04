<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Categories &laquo; Admin</title>
    <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<script>NProgress.start()</script>
<?php include_once '../common/prevent.php'; ?>
<?php
include_once '../common/mysql_connect.php';
$id = $_GET['id'];
$sql = "select * from ali_cate WHERE cate_id = $id";
$res = mysql_query($sql);
$info = mysql_fetch_assoc($res);
?>
<div class="main">
    <?php include_once '../common/nav.php'; ?>
    <div class="container-fluid">
        <div class="page-title">
            <h1>分类目录</h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                <form method="post" action="editcate_deal.php">
                    <h2>添加新分类目录</h2>
                    <input type="hidden" name="id" value="<?= $info['cate_id']?>">
                    <div class="form-group">
                        <label for="name">名称</label>
                        <input id="name" class="form-control" name="name" type="text" value="<?= $info['cate_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="slug">别名</label>
                        <input id="slug" class="form-control" name="slug" type="text" value="<?= $info['cate_slug']; ?>">
                        <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
                    </div>
                    <div class="form-group">
                        <label for="icon">图标</label>
                        <input id="slug" class="form-control" name="icon" type="text" value="<?= $info['cate_class']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">分类状态</label>
                        <input type="radio" name="status" value="1" <?php echo $info['cate_status'] == 1 ? 'checked' : ''; ?>>启用
                        <input type="radio" name="status" value="2" <?php echo $info['cate_status'] == 2 ? 'checked' : ''; ?>>禁用
                    </div>
                    <div class="form-group">
                        <label for="show">是否显示</label>
                        <input type="radio" name="show" value="1" <?php echo $info['cate_show'] == 1 ? 'checked' : ''; ?>>显示
                        <input type="radio" name="show" value="2" <?php echo $info['cate_show'] == 2 ? 'checked' : ''; ?>>隐藏
                    </div>
                    <div class="form-group">
                        <input type="submit" value="修改" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="aside">
    <?php include '../common/aside.php'; ?>
</div>

<script src="../../assets/vendors/jquery/jquery.js"></script>
<script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
<script>NProgress.done()</script>
<script src="../common/check.js"></script>
</body>
</html>