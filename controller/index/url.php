<?php
/*
    前台URL控制器
    ---------------------------------------
*/

#调用前台controller
if(!empty($_GET['i'])) U($_GET['i']);

#调用后台controller
if(!empty($_GET['a'])) U(implode('&',$_GET),0,null,'admin');

#调用前台视图
if(!empty($_GET['d'])) display($_GET['d']);