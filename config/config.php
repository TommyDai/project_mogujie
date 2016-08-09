<?php

#全局配置
session_start();
const DB_NAME                 = 's48_shop';
const DB_HOST                 = 'localhost';
const DB_USER                 = 'root';
const DB_PWD                  = '';
const ERROR                   = 0;      //1不屏蔽错误  0屏蔽错误
const TIMEZONE                = 'PRC';  //设置时区     PRC中国
const ERROR_404               = 'ON';   //当页面出错'ON'抛出404页面,'OFF'抛出错误提示

#是否屏错误
ini_set('display_errors', ERROR);

#设置所在时区
date_default_timezone_set(TIMEZONE);

#用户函数
require './model/userFunc.php';

#数据库连接
$link = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
if(mysqli_connect_errno($link)){
  echo mysqli_connect_error($link);exit;
}
mysqli_set_charset($link,'utf8');