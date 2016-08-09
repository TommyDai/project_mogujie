<?php
/*
    多图片同时上传函数
    -----------------------------------------------
    @auther  Tommy Dai
    -----------------------------------------------
    @parem  $name  str  传input表单name值
    -----------------------------------------------
    @parem  $dir   str  传要保存的目录
    -----------------------------------------------
    @return  array      返回文件名数组
    -----------------------------------------------
*/

function imgUp($name, $dir='./uploads/'){
  $fname = $_FILES[$name]['name'];
  $length = count($fname);
  for($i=0;$i<$length;$i++){
    $type = pathinfo($fname[0],PATHINFO_EXTENSION);
    if(empty($type)) continue;
    if(!in_array($type,['jpg','jpeg','gif','png'])){
      echo '请上传jpg/jpeg/gif/png格式的图片!';
      return false;
    }
    $file = $_FILES[$name]['tmp_name'][$i];
    if(empty($file)) continue;
    if(!is_uploaded_file($file)){
      echo '请使用post方式上传';
      return false;
    }
    $fdir = rtrim($dir,'/').date('/Y/m/d/');
    $refile = $fdir.date('Ymd').uniqid().mt_rand(0,9999).'.'.$type;
    if(!file_exists($fdir)) mkdir($fdir,777,true);
    if(!move_uploaded_file($file,$refile)){
      echo '上传失败';
      return false;
    }   
    $arr[] = $refile;
  }
  return $arr;
}