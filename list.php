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
    <?php
    include_once 'c.php';
    $id = $_GET['id'];
    $name = $_GET['name'];
    ?>
    <div class="content">
        <div class="panel new">
            <h3><?=$name;?></h3>
            <?php
            $infoRes = mysql_query("select n, post_id, post_title, post_uptime, post_desc, post_file, post_click, post_good, cate_name, user_nickname
from ali_post AS p
LEFT JOIN (select cmt_postid, COUNT(*) AS n from ali_comment GROUP BY cmt_postid) AS r ON p.post_id = r.cmt_postid
JOIN ali_cate AS c ON p.post_cateid = c.cate_id
JOIN ali_user AS u ON p.post_author = u.user_id
WHERE cate_id = $id
ORDER BY post_uptime DESC limit 0, 3");
            while ($row = mysql_fetch_assoc($infoRes)) {
            ?>
            <div class="entry">
                <div class="head">
                    <span class="sort"><?= $row['cate_name']; ?></span>
                    <a href="detail.php?id=<?=$row['post_id'];?>"><?= $row['post_title']; ?></a>
                </div>
                <div class="main">
                    <p class="info"><?= $row['user_nickname']; ?> 发表于 <?= date('Y-m-d', $row['post_uptime']); ?></p>
                    <p class="brief"><?= htmlspecialchars_decode($row['post_desc']); ?></p>
                    <p class="extra">
                        <span class="reading">阅读(<?= $row['post_click']; ?>)</span>
                        <span class="comment">评论(<?= $row['n'] == 0 ? 0 : $row['n']; ?>)</span>
                        <a href="javascript:;" class="like">
                            <i class="fa fa-thumbs-up"></i>
                            <span>赞(<?= $row['post_good']; ?>)</span>
                        </a>
                    </p>
                    <a href="javascript:;" class="thumb">
                        <img src="<?= '/admin' . strchr($row['post_file'], '/'); ?>" alt="">
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="footer">
        <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
</div>
</body>
</html>
