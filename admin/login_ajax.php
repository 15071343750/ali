<?php
/**
 * Created by PhpStorm.
 * User: 小新
 * Date: 2018/1/15
 * Time: 18:49
 */
$code = $_POST['code'];
session_start();
if ($_SESSION['code'] == $code) {
    echo 1;
} else {
    echo 0;
}