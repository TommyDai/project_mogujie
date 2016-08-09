<?php
/*
    核心文件
    -----------------------------------------
    @auther  Tommy Dai          
    -----------------------------------------
    超迷你型框架Dphp，像搭积木一样编程
    -----------------------------------------
*/

#设置主页
$controller = empty($_GET['c']) ? controller('index') : controller($_GET['c']);

#控制器调用
function controller($controller){
  $control = CONTROLLER_PATH.$controller.'.php';
  file_exists($control) ? require_once($control) : noPage('控制器',$control);
}

#模型调用
function model($func,$a=null,$b=null,$c=null,$d=null,$e=null,$f=null){
  $model = MODEL_PATH.$func.'.php';
  file_exists($model) ? require_once($model) : noPage('模型',$model);
  return function_exists($func) ? $func($a,$b,$c,$d,$e,$f) : null;
}

#视图调用
function display($page,$a=null,$b=null,$c=null,$d=null,$e=null,$f=null){
  $view = VIEW_PATH.$page.'.html';
  file_exists($view) ? require_once($view) : noPage('视图',$view);
}