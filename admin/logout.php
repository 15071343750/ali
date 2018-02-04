<?php
/**
 * Created by PhpStorm.
 * User: 小新
 * Date: 2018/1/15
 * Time: 16:56
 */
session_start();
session_destroy();
header("location: login.html");