<?php
header("content-type:text/html;charset=utf8");
include_once '../common/prevent.php';

$name = $_POST['site_name'];
$desc = $_POST['site_description'];
$keys = $_POST['site_keywords'];
$pl = isset($_POST['comment_status']) ? $_POST['comment_status'] : 0;
$allow = isset($_POST['comment_reviewed']) ? $_POST['comment_reviewed'] : 0;

$site = include_once 'settings.conf.php';
$old_logo = $site['site_logo'];

$new_logo = '';
if ($_FILES['logo']['error'] == 0) {
    $ext = strrchr($_FILES['logo']['name'], '.');
    $new_logo = '../uploads/s' . date('YmgHis-') . mt_rand(10, 99) . $ext;
    move_uploaded_file($_FILES['logo']['tmp_name'], $new_logo);
}
if ($new_logo) {
    unlink($old_logo);
} else {
    $new_logo = $old_logo;
}
/*
    fopen(var1，var2) : 打开一个文件
    参数1: 要打开的文件的路径
    参数2: 打开的方式
           r（read）: 以只读方式打开文件
           w(write) : 以写入方式打开文件，如果该文件不存在则自动创建，将文件中的内容自动清空。
    返回值: 文件资源

    fwrite(var1, var2): 将一段文字写入文件
    参数1: 文件资源
    参数2: 要写入的内容。
*/
$fo = fopen('settings.conf.php', 'w');
$str = "<?php
include_once '../common/prevent.php';
// 网站配置，用来读取重写的文件
return array(
    'site_logo' => '$new_logo',
    'site_name' => '$name',
    'site_desc' => '$desc',
    'site_keys' => '$keys',
    'site_pl' => $pl,
    'site_allow' => $allow
);";
fwrite($fo, $str);
echo '重新设置成功';
header("refresh: 2; url = settings.php");