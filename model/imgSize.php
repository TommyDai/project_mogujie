<?php
/**
 * 缩放函数
 * 
 * @author MartinLee lixiang@lampbrother.net
 *
 * @param  string    $img_path   图片路径
 * @param  int       $width      缩放后的宽
 * @param  int       $height     缩放后的高
 * @return  没有返回值，函数自动保存缩放好的图片
 **/

function imgSize($img_path, $width, $height){

  $width = empty($width) ? 100 : $width;
  $height = empty($height) ? 100 : $height;
  // 1.获取图片的后缀
  $suffix = ltrim(strrchr($img_path, '.'),'.');

  if($suffix == 'jpg'){
      $suffix = 'jpeg';
  }

  // 拼接两个函数名
  // 创建图片资源的函数名
  // imagecreatefromjpeg imagecreatefrompng imagecreatefromgif
  $func_resource = 'imagecreatefrom'.$suffix;

  // 保存图片的函数名
  // imagejpeg  imagepng   imagegif
  $func_save = 'image'.$suffix;

  //echo $func_resource.'<br/>';
  //echo $func_save.'<br/>';
  //exit;

  // 获取原图的宽和高
  list($src_w, $src_h)=getimagesize($img_path);
  
  // 直接缩放
  // 打开原图产生资源
  $src =$func_resource($img_path);

  // 创建小图
  $dst = imagecreatetruecolor($width, $height);

  // 专业缩放的函数
  imagecopyresampled($dst, $src, 0,0, 0,0, $width, $height, $src_w, $src_h);


  // 处理缩放后的完整图片路径
  $save_path = dirname($img_path).'/'.$width.'_'.basename($img_path);

  // 保存缩放后的图片
  // imagejpeg imagepng imagegif  保存成功返回真，保存失败返回假
  $result = $func_save($dst, $save_path);

  // 销毁资源
  imagedestroy($src);
  imagedestroy($dst);

  if($result) return $save_path;
}
