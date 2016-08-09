<?php
/*
    自定义函数库
    ----------------------------------------------------
*/

#echo
function E($val){
  echo $val;
}

#var_dump
function V($val){
  var_dump($val);
}

#url refresh
function U($c, $time=0, $text=null, $url=URL_PATH){
  if(substr($c,0,7)=='http://'){
    $c = ltrim(stristr($c,'c='),'c=');
  }
  echo '<meta http-equiv="refresh" content="'.round($time).';url='.$url.'.php?c='.$c.'">';
  if($time>0){
    $html=<<<EXO
    <body bgcolor="#fdfdfd">
    <div style="background:url(public/images/a.png)no-repeat 10px 1px;margin:150px auto;border-radius:10px;color:#E62E7A;font:16px 微软雅黑;padding:100px;width:400px;height:100px;text-align:center">
    <h4>{$text}</h4>
    <p>&nbsp;{$time}&nbsp;秒后跳转</p>
    <div>
    </body>
EXO;
    echo $html;
  }
}

#404页面抛出
function noPage($val1,$val2){
  if(ERROR_404 == 'ON') display('error');
  if(ERROR_404 == 'OFF') print($val1.$val2.'未找到!');
}

#生成随机字符
function randStr($leng=6){
  $str = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890';
  $str = str_shuffle($str);
  $str = substr($str,0,$leng);
  return $str;
}

#有相同值的二维数组拼接
function arrPin($a1,$k1,$a2,$k2){
  if(is_array($a1) && is_array($a2)){
    $arr = array();
    foreach($a1 as $v1){
      foreach($a2 as $v2){
        if($v1[$k1] == $v2[$k2]){
          $arr[] = array_merge($v1,$v2);
        }
      }
    }
    return $arr;
  }else{
    return false;
  }
}