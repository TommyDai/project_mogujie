<?php
/*
    验证码函数
    -------------------------------------------------
    @auther Tommy Dai   Email:236860783@qq.com
    -------------------------------------------------
    @parem  $width      int 图像宽度
    -------------------------------------------------
    @parem  $height     int 图像高度
    -------------------------------------------------
    @parem  $num        int 验证码字符个数
    -------------------------------------------------
    @parem  $fontsize   int 字体大小
    -------------------------------------------------
    @return 无
    -------------------------------------------------
*/
code();
function code($width=100, $height=33, $num=4, $fontsize=18){
  $img = imagecreatetruecolor($width, $height);
  $color = imagecolorallocate($img, mt_rand(200,255), mt_rand(200,255), mt_rand(200,255));
  imagefill($img, 0, 0, $color);
  $str = 'abcdefghjkmnpqrst23456789uvwxyzQWERTYUPKJHGFDSAZXCVBNM';
  $str = str_shuffle($str);
  $str = substr($str, 0, $num);
  session_start();
  $_SESSION['code'] = $str;
  for($i=0;$i<$num;$i++){
    $x = (($width)/$num)*$i+2;
    $y = (($height-$fontsize)/2)+$fontsize;
    $fcolor = imagecolorallocate($img, mt_rand(50,160), mt_rand(50,160), mt_rand(50,160));
    imagettftext($img,$fontsize,rand(-20,20),$x,$y,$fcolor,'../public/fonts/msyh.ttf',$str{$i});
  }
  for($a=0;$a<4;$a++){
    $fcolor = imagecolorallocate($img, mt_rand(50,200), mt_rand(50,200), mt_rand(50,200));
    imageline($img,rand(0,$width),rand(0,$height),rand(50,$width),rand(0,$height),$fcolor);
  }
  for($j=0;$j<200;$j++){
    $fcolor = imagecolorallocate($img, mt_rand(50,200), mt_rand(50,200), mt_rand(50,200));
    imagesetpixel($img,rand(0,$width),rand(0,$height),$fcolor);
  }
  header('content-type:image/png');
  imagepng($img);
  imagedestroy($img);
}