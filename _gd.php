<?php
header("Content-type: image/png");
// image/png中的png和第五步中的显示或者保存路径的函数对应imagepng()
/**
 * Created by PhpStorm.
 * User: 小新
 * Date: 2018/1/15
 * Time: 9:24
 */
// GD绘图

// 1、创建真色彩画布
$img = imagecreatetruecolor(600, 400);

// 2、创建画笔(创建颜色)
// 参数1：画布   参数2 3 4对应r g b
$red = imagecolorallocate($img, 255, 0, 0);
$green = imagecolorallocate($img, 0, 255, 0);
$blue = imagecolorallocate($img, 0, 0, 255);
$blue2 = imagecolorallocate($img, 0, 153, 221);

// 3、填充画布颜色
// 参数1：画布   参数2 3：坐标    参数4：画笔
// 坐标只要是在画布上就可以，用颜色填充整个画布
imagefill($img, 0, 0, $blue2);

// 4、绘图(使用GD库提供的各种绘制函数)
//imagestring($img, 7, 10, 30, 'string', $green);
imagefilledellipse($img, 200, 200, 100, 100, $green);

// 5、显示或者保存已经绘制好的图片
// imagejpeg();
// imagegif();
// 参数1：画布
// 参数2：图片的保存路径(如果有参数2，则进行图片的保存，如果没有，就行图片的显示)；显示和保存时互斥的
imagepng($img);

// 6、销毁画布资源
imagedestroy($img);