-- 分类页面的数据表
CREATE TABLE ali_cate(
  cate_id int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  cate_name VARCHAR(10) NOT NULL UNIQUE COMMENT '分类名称',
  cate_slug VARCHAR(10) NOT NULL COMMENT '分类别名',
  cate_class VARCHAR(20) NOT NULL UNIQUE COMMENT '图标的class类名',
  cate_status tinyint(4) NOT NULL DEFAULT 1 COMMENT '分类状态 1启用  2禁用',
  cate_show tinyint(4) NOT NULL DEFAULT 1 COMMENT '分类是否显示在首页的导航条中 1显示 2隐藏'
);

-- 用户页面的数据表
CREATE TABLE ali_user(
user_id INT unsigned AUTO_INCREMENT PRIMARY KEY,
user_email VARCHAR(30) UNIQUE NOT NULL comment '用户账号',
user_slug VARCHAR(30) UNIQUE NOT NULL comment '用户别名',
user_nickname VARCHAR(30) UNIQUE NOT NULL comment '用户昵称',
user_psw  CHAR(32) NOT NULL comment '密码',
user_pic VARCHAR(100) NOT NULL DEFAULT '/assets/img/default.png' comment '用户头像',
user_status tinyint(4) NOT NULL DEFAULT 1
);
INSERT INTO ali_user VALUES (NULL, '941024@163.com', 'xin', '蜡笔', '77424d363e18fe4c5aa0d8b356fbbe91', '/uploads/xin.jpg', 1);
INSERT INTO ali_user VALUES (NULL, '163@163.com', 'aaa', 'AAA', '77424d363e18fe4c5aa0d8b356fbbe91', '', 0);
INSERT INTO ali_user VALUES (NULL, '99@qq.com', 'bbb', 'BBB', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, '66@qq.com', 'ccc', 'CCC', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, '111@qq.com', 'ddd', 'DDD', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, '222@qq.com', 'eee', 'EEE', '77424d363e18fe4c5aa0d8b356fbbe91', '', 0);
INSERT INTO ali_user VALUES (NULL, '333@qq.com', 'fff', 'FFF', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, '444@qq.com', 'ggg', 'GGG', '77424d363e18fe4c5aa0d8b356fbbe91', '', 0);
INSERT INTO ali_user VALUES (NULL, '555@qq.com', 'hhh', 'HHH', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, '666@qq.com', 'iii', 'III', '77424d363e18fe4c5aa0d8b356fbbe91', '', 0);
INSERT INTO ali_user VALUES (NULL, '777@qq.com', 'jjj', 'JJJ', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, '888@qq.com', 'kkk', 'KKK', '77424d363e18fe4c5aa0d8b356fbbe91', '', 0);
INSERT INTO ali_user VALUES (NULL, '999@qq.com', 'lll', 'LLL', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, '123@qq.com', 'mmm', 'MMM', '77424d363e18fe4c5aa0d8b356fbbe91', '', 0);
INSERT INTO ali_user VALUES (NULL, '234@qq.com', 'nnn', 'NNN', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, '345@qq.com', 'ooo', 'OOO', '77424d363e18fe4c5aa0d8b356fbbe91', '', 0);
INSERT INTO ali_user VALUES (NULL, '456@qq.com', 'ppp', 'PPP', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, '567@qq.com', 'qqq', 'QQQ', '77424d363e18fe4c5aa0d8b356fbbe91', '', 0);
INSERT INTO ali_user VALUES (NULL, '678@qq.com', 'rrr', 'RRR', '77424d363e18fe4c5aa0d8b356fbbe91', '', 0);
INSERT INTO ali_user VALUES (NULL, '789@qq.com', 'sss', 'SSS', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, 'qew@qq.com', 'ttt', 'TTT', '77424d363e18fe4c5aa0d8b356fbbe91', '', 0);
INSERT INTO ali_user VALUES (NULL, 'qwe@qq.com', 'uuu', 'UUU', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, 'fa@qq.com', 'afd', 'FASD', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, 'fasdaf@qq.com', 'sdd', 'UUU', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, 'faasdf@qq.com', 'wer', '4FFS', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, 'vxc@qq.com', 'wref', '3RWF', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, 'sa@qq.com', 'dsfsf', '34FERF', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, 'hgsdf@qq.com', 'qew', 'WERRWRQ', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, 'addsa@qq.com', 'sdfsdf', 'WERW', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, 'vxc@qq.com', 'sfdfsf', 'WERW', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, 'erw@qq.com', 'sdfswqe', 'GSA', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);
INSERT INTO ali_user VALUES (NULL, 'tyty@qq.com', 'khjh', 'JGFGJ', '77424d363e18fe4c5aa0d8b356fbbe91', '', 1);

-- 文章数据表
CREATE TABLE ali_post(
post_id int unsigned AUTO_INCREMENT PRIMARY KEY,
post_title VARCHAR(30) UNIQUE NOT NULL COMMENT '文章标题',
post_slug VARCHAR(30) UNIQUE NOT NULL comment '文章别名',
post_desc VARCHAR(255) NOT NULL comment '文章摘要',
post_content text NOT NULL comment '文章内容',
post_author INT NOT NULL comment '作者id，和user_id对应',
post_cateid INT NOT NULL comment '分类id，和cate_id对应',
post_file VARCHAR(100) NOT NULL DEFAULT '' comment '文章封面图片',
post_addtime INT unsigned NOT NULL comment '文章发布时间',
post_uptime INT unsigned NOT NULL comment '文章修改时间',
post_click INT unsigned NOT NULL comment '点击量',
post_good INT unsigned NOT NULL comment '赞',
post_bad INT unsigned NOT NULL comment '踩',
post_state enum('草稿', '已发布') NOT NULL DEFAULT '草稿' comment '文章状态'
) charset=utf8;
SELECT post_id, post_title, user_nickname, cate_name, post_uptime, post_state FROM ali_post AS p
JOIN ali_user AS u on p.post_author = u.user_id
JOIN ali_cate AS c on p.post_cateid = c.cate_id;

-- 会员（评论者）表
CREATE TABLE ali_member(
member_id INT unsigned AUTO_INCREMENT PRIMARY KEY,
member_name VARCHAR(30) UNIQUE NOT NULL comment '会员名，用来登录',
member_nickname VARCHAR(30) UNIQUE NOT NULL comment '会员昵称，评论时用的名称',
member_psw CHAR(20) NOT NULL comment '会员密码'
);

-- 评论相关表
CREATE TABLE ali_comment(
cmt_id INT unsigned NOT NULL PRIMARY KEY,
cmt_content VARCHAR(200) NOT NULL comment '评论内容',
cmt_memberid INT unsigned NOT NULL comment '评论人id，和member_id对应',
cmt_userid INT unsigned NOT NULL comment '审核人id',
cmt_postid INT unsigned NOT NULL comment '每篇文章id',
cmt_time INT unsigned comment '评论时间',
cmt_state enum('批准', '驳回') NOT NULL DEFAULT '驳回'
);

-- 图片轮播数据表
CREATE TABLE ali_pic(
pic_id INT unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
pic_path VARCHAR(100) NOT NULL comment '轮播图片的路径',
pic_txt VARCHAR(20) NOT NULL comment '文章标题，显示在图片左下角的文字',
pic_link VARCHAR(20) NOT NULL comment '图片链接',
pic_state enum('显示', '不显示') NOT NULL DEFAULT '不显示' comment '图片是否展示'
);