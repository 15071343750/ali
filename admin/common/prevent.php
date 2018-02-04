<?php
/**
 * Created by PhpStorm.
 * User: 小新
 * Date: 2018/1/15
 * Time: 17:06
 防跳墙文件
 */
//session_id() 返回当前会话ID。 如果当前没有会话，则返回空字符串（""）
if(!session_id()) {
    session_start();
}
if (empty($_SESSION['userInfo'])) {
    echo '请先登录';
    header("refresh: 2; url = ../login.html");
    die();
}