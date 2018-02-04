<?php
header("Content-type: image/png");

$arrNum = range(2, 8);
$arrStr = range('a', 'z');
$arr = array_merge($arrNum, $arrStr); // 总数组
shuffle($arr);
$len = 4;       // 验证码长度
$verify = '';   // 验证码字符串
$randNum = array_rand($arr, $len);
foreach ($randNum as $v) {
    $verify .= $arr[$v];
}

session_start();
$_SESSION['code'] = $verify;

$img = imagecreatetruecolor(85, 34);
$imgBg = imagecolorallocate($img, 249, 235, 208);
imagefill($img, 0, 0, $imgBg);
for ($i = 0; $i < $len; $i++) {
    imagettftext(
        $img,               // 画布
        mt_rand(16, 20),    // 字体大小
        mt_rand(-30, 30),   // 字体倾斜角度 PHP的角度和canvas不一样
        3 + $i * 21,        // 起始横坐标
        25,                 // 起始纵坐标  坐标是以左下角为基准
        imagecolorallocate($img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255)), // 字体颜色
        'REFSAN.TTF',       // 字体路径
        $verify[$i]         // 字符
    );
}
imagepng($img);
imagedestroy($img);