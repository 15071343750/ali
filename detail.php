<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>阿里百秀-发现生活，发现美!</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
<div class="wrapper">
    <?php include_once 'c.php'; ?>
    <div class="content">
        <?php
        include_once 'admin/common/mysql_connect.php';
        $id = $_GET['id'];
        $infoRes = mysql_query("select n, post_id, post_title, post_uptime, post_desc, post_content, post_file, post_click, cate_name, user_nickname
from ali_post AS p
LEFT JOIN (select cmt_postid, COUNT(*) AS n from ali_comment GROUP BY cmt_postid) AS r ON p.post_id = r.cmt_postid
JOIN ali_cate AS c ON p.post_cateid = c.cate_id
JOIN ali_user AS u ON p.post_author = u.user_id
WHERE post_id = $id");
        $row = mysql_fetch_assoc($infoRes);
        ?>
        <div class="article">
            <div class="breadcrumb">
                <dl>
                    <dt>当前位置：</dt>
                    <dd><a href="javascript:;"><?=$row['cate_name'];?></a></dd>
<!--                    <dd><a href="javascript:;">--><?//=$row['post_desc'];?><!--</a></dd>-->
                </dl>
            </div>
            <h2 class="title">
                <a href="javascript:;"><?=$row['post_title'];?></a>
            </h2>
            <div class="meta">
                <span><?=$row['user_nickname'];?> 发布于 <?=date('Y-m-d', $row['post_uptime']);?></span>
                <span>分类: <a href="javascript:;"><?=$row['cate_name'];?></a></span>
                <span>阅读: (<?=$row['post_click'];?>)</span>
                <span>评论: (<?=$row['n'] == 0 ? 0 : $row['n'];?>)</span>
            </div>
            <div><?=htmlspecialchars_decode($row['post_content']);?></div>
        </div>



        <div class="panel hots">
            <h3>热门推荐</h3>
            <?php
            $rmRes = mysql_query("select post_id, post_file, post_title from ali_post WHERE post_state = 1 AND post_file != 'null' ORDER BY rand() limit 0, 4");
            ?>
            <ul>
                <?php while ($row = mysql_fetch_assoc($rmRes)) { ?>
                    <li>
                        <a href="javascript:;">
                            <img src="<?= '/admin' . strchr($row['post_file'], '/'); ?>" alt="">
                            <span><?= $row['post_title']; ?></span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>

    </div>
    <div class="footer">
        <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
</div>
</body>
</html>
