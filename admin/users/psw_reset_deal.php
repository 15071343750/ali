<?php

header("content-type:text/html;charset=utf8");
include_once '../common/prevent.php';
include_once '../common/mysql_connect.php';
@$oldpsw = trim($_POST['oldpsw']);
$user_psw = $_SESSION['userInfo'];  // session机制在引入的文件中已经开启
if (md5($oldpsw) != $user_psw) {
    echo '旧密码不正确';
    header("refresh: 2; url = psw_reset.php");
    die();
} else {
    @$newpsw = trim($_POST['newpsw']);
    @$rNewpsw = trim($_POST['rNewpsw']);
    if ($newpsw == $rNewpsw) {
        $md5newpsw = md5($newpsw);
        $id = $_SESSION['userId'];
        $sql = "update ali_user set user_psw = '$md5newpsw' where user_id = $id";
        mysql_query($sql);
        $num = mysql_affected_rows($link);
        if($num > 0){
            echo "修改密码成功，请重新登录";
            session_destroy();
            header('Refresh: 2; url = ../login.html');
            die;
        } else {
            echo "修改密码失败";
            header('Refresh: 2; url = psw_reset.php');
            die;
        }
    } else {
        echo "两次新密码不一致";
        header('Refresh: 2; url = psw_reset.php');
        die;
    }
}