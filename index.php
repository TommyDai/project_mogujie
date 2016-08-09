<?php
/*
    前台入口文件
    -----------------------------------------
    @auther  Tommy Dai 
    -----------------------------------------
    超迷你型框架Dphp，像搭积木一样编程
    -----------------------------------------
*/


#引入配置文件
require_once './config/indexconfig.php';

#引入核心文件
require_once './core/Dphpcore.php';

#关闭数据库连接
if(isset($link)) mysqli_close($link);

$_SESSION['U'] = empty($_SERVER['HTTP_REFERER']) ? 0 : $_SERVER['HTTP_REFERER'];