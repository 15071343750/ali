<?php
include_once 'admin/common/mysql_connect.php';
?>
<div class="topnav"> <!-- 响应式设计 <768px时显示 -->
    <ul>
        <?php
        $cateRes = mysql_query("select * from ali_cate WHERE cate_status = 1 AND cate_show = 1");
        while ($row = mysql_fetch_assoc($cateRes)) {
            ?>
            <li><a href="list.php?id=<?= $row['cate_id'];?>&name=<?= $row['cate_name'];?>"><i class="fa <?=$row['cate_class'];?>"></i><?=$row['cate_name'];?></a></li>
        <?php } ?>
    </ul>
</div>
<div class="header">
    <h1 class="logo"><a href="index.php"><img src="assets/img/logo.png" alt=""></a></h1>
    <ul class="nav">
        <?php
        $cateRes = mysql_query("select * from ali_cate WHERE cate_status = 1 AND cate_show = 1");
        while ($row = mysql_fetch_assoc($cateRes)) {
        ?>
        <li><a href="list.php?id=<?= $row['cate_id'];?>&name=<?= $row['cate_name'];?>"><i class="fa <?=$row['cate_class'];?>"></i><?=$row['cate_name'];?></a></li>
        <?php } ?>
    </ul>
    <div class="search">
        <form>
            <input type="text" class="keys" placeholder="输入关键字">
            <input type="submit" class="btn" value="搜索">
        </form>
    </div>
    <div class="slink">
        <a href="javascript:;">用来添加链接</a> | <a href="javascript:;">用来添加链接</a>
    </div>
</div>
<div class="aside">
    <div class="widgets">
        <h4>搜索</h4>
        <div class="body search">
            <form>
                <input type="text" class="keys" placeholder="输入关键字">
                <input type="submit" class="btn" value="搜索">
            </form>
        </div>
    </div>
    <div class="widgets">
        <h4>随机推荐</h4>
        <?php
        $sjRes = mysql_query("select * from ali_post order by rand() limit 0, 5");
        ?>
        <ul class="body random">
            <?php while ($row = mysql_fetch_assoc($sjRes)) { ?>
            <li>
                <a href="javascript:;">
                    <p class="title"><?=$row['post_title'];?></p>
                    <p class="reading">阅读(<?=$row['post_click'];?>)</p>
                    <div class="pic">
                        <img src="<?='/admin' . strchr($row['post_file'], '/');?>" alt="">
                    </div>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="widgets">
        <h4>最新评论</h4>
        <?php
        $plRqs = mysql_query("select member_pic, member_nickname, cmt_time, cmt_content, cmt_postid from ali_member AS m JOIN ali_comment AS c ON m.member_id = c.cmt_memberid WHERE cmt_state = '批准' ORDER BY cmt_time DESC limit 0, 6");
        ?>
        <ul class="body discuz">
            <?php while ($row = mysql_fetch_assoc($plRqs)) { ?>
            <li>
                <a href="javascript:;">
                    <div class="avatar">
                        <img src="<?=$row['member_pic'];?>" alt="">
                    </div>
                    <div class="txt">
                        <p>
                            <span><?=$row['member_nickname'];?></span>9个月前(<?=date('m-d', $row['cmt_time']);?>)说:
                        </p>
                        <p><?=$row['cmt_content'];?></p>
                    </div>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>