<?php
/*
    后台URL控制器
    ---------------------------------------
*/

#调用前台controller
if(!empty($_GET['i'])) U(implode('&',$_GET),0,null,'index');

#调用后台controller
if(!empty($_GET['a'])) U($_GET['a']);

#调用后台视图
if(!empty($_GET['d'])) display($_GET['d']);