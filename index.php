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
<?php include_once 'admin/common/mysql_connect.php'; ?>
<div class="wrapper">
    <?php include_once 'c.php'; ?>
    <div class="content">
        <div class="swipe">
            <?php
            $slidePicRes = mysql_query("select * from ali_pic WHERE pic_state = '显示'");
            $slideNum = mysql_num_rows($slidePicRes);
            ?>
            <ul class="swipe-wrapper">
                <?php while ($row = mysql_fetch_assoc($slidePicRes)) { ?>
                <li>
                    <a href="#">
                        <img src="<?= '/admin' . strchr($row['pic_path'], '/'); ?>">
                        <span><?=$row['pic_txt'];?></span>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <p class="cursor">
                <?php for ($i = 0; $i < $slideNum; $i++) { ?>
                <span <?= $i == 0 ? "class=\"active\"" : ''; ?>></span>
                <?php } ?>
            </p>
            <a href="javascript:;" class="arrow prev"><i class="fa fa-chevron-left"></i></a>
            <a href="javascript:;" class="arrow next"><i class="fa fa-chevron-right"></i></a>
        </div>
        <div class="panel focus">
            <h3>焦点关注</h3>
            <ul>
                <?php
                $jdRes = mysql_query("select post_id, post_title, post_file from ali_post WHERE post_hot = '推荐' AND post_state = 1 AND post_file != 'null' ORDER BY post_uptime DESC limit 0, 5");
                $jdNum = 1;
                while ($row = mysql_fetch_assoc($jdRes)) {
                ?>
                <li <?= $jdNum == 1 ? "class=\"large\"" : '';?>>
                    <a href="javascript:;">
                        <img src="<?= '/admin' . strchr($row['post_file'], '/'); ?>" alt="">
                        <span><?= $row['post_title']; ?></span>
                    </a>
                </li>
                <?php $jdNum++; } ?>
            </ul>
        </div>
        <div class="panel top">
            <h3>一周热门排行</h3>
            <?php
            $yzrmRes = mysql_query("select post_id, post_title, post_good, post_click from ali_post WHERE post_state = 1 ORDER BY post_uptime DESC, post_click DESC limit 0, 5");
            $rmNum = 1;
            ?>
            <ol>
                <?php while ($row = mysql_fetch_assoc($yzrmRes)) { ?>
                <li>
                    <i><?= $rmNum; ?></i>
                    <a href="javascript:;"><?= $row['post_title']; ?></a>
                    <a href="javascript:;" class="like">赞(<?= $row['post_good']; ?>)</a>
                    <span>阅读 (<?= $row['post_click']; ?>)</span>
                </li>
                <?php $rmNum++; } ?>
            </ol>
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
        <div class="panel new">
            <h3>最新发布</h3>
            <?php
            $zxRes = mysql_query("select n, post_id, post_title, post_uptime, post_desc, post_file, post_click, post_good, cate_name, user_nickname
from ali_post AS p
LEFT JOIN (select cmt_postid, COUNT(*) AS n from ali_comment GROUP BY cmt_postid) AS r ON p.post_id = r.cmt_postid
JOIN ali_cate AS c ON p.post_cateid = c.cate_id
JOIN ali_user AS u ON p.post_author = u.user_id
WHERE user_status = 1 AND post_state = 1 AND cate_status = 1 AND cate_show = 1
ORDER BY post_uptime DESC limit 0, 3");
// 用户的状态user_status要是激活的
// 文章的状态post_state要是已发布的
// 分类的启用状态cate_status要是启用的而且显示状态cate_show要是显示的
            while ($row = mysql_fetch_assoc($zxRes)) {
            ?>
            <div class="entry">
                <div class="head">
                    <span class="sort"><?= $row['cate_name']; ?></span>
                    <a href="detail.php?id=<?= $row['post_id'];?>"><?= $row['post_title']; ?></a>
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
<script src="assets/vendors/jquery/jquery.js"></script>
<script src="assets/vendors/swipe/swipe.js"></script>
<script>
    //
    var swiper = Swipe(document.querySelector('.swipe'), {
        auto: 3000,
        transitionEnd: function (index) {
            // index++;

            $('.cursor span').eq(index).addClass('active').siblings('.active').removeClass('active');
        }
    });

    // 上/下一张
    $('.swipe .arrow').on('click', function () {
        var _this = $(this);

        if (_this.is('.prev')) {
            swiper.prev();
        } else if (_this.is('.next')) {
            swiper.next();
        }
    })
</script>
</body>
</html>
