<?php
/*
    单图片上传函数
    -----------------------------------------------
    @auther  Tommy Dai
    -----------------------------------------------
    @parem  $name  str  传$_FILES
    -----------------------------------------------
    @parem  $dir   str  传要保存的目录
    -----------------------------------------------
    @return  array      返回文件名数组
    -----------------------------------------------
*/

function imgUp($name, $dir){

  #获取图片文件名
  $fname = $_FILES[key($_FILES)]['name'];

  #获取图片扩展名
  $type = pathinfo($fname,PATHINFO_EXTENSION);

  #判断类型
  if(!in_array($type,['jpg','jpeg','gif','png'])){
    echo '请上传jpg/jpeg/gif/png格式的图片!';
    return false;
  }

  #获取临时路径
  $file = $_FILES[key($_FILES)]['tmp_name'];

  #判断是否为post提交
  if(!is_uploaded_file($file)) return false;

  #设置保存路径
  $dir = empty($dir) ? UPLOAD_PATH : $dir;
  $fdir = rtrim($dir,'/').date('/Y/m/d/');

  #组装文件名
  $refile = $fdir.date('Ymd').uniqid().mt_rand(0,9999).'.'.$type;

  #检测路径是否存在不存在创建之
  if(!file_exists($fdir)) mkdir($fdir,777,true);

  #复制图片到服务器
  if(!move_uploaded_file($file,$refile)) return false;

  #返回文件名
  return $refile;
}