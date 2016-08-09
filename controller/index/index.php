<?php
/*
    index控制器
    ------------------------------------------------
*/

#查询分类
$sql = "SELECT id,name nav,display
          FROM s48_category
         WHERE pid=0
         LIMIT 13";
$res = model('dbSql',$sql);
$pid = '';
foreach($res as $v){
  $pid .= $v['id'].','; 
}
$pid = rtrim($pid,',');
$sql = "SELECT id,name,pid,display
          FROM s48_category 
         WHERE pid IN({$pid})
      ORDER BY pid";
$cat = dbSql($sql);
foreach($cat as $val){
  foreach($val as $ca){
    $arr[] = $ca;
  }
}
$cat = array_chunk($arr,12);
$nav = arrPin($res,'id',$cat,2);

#查询主页夏上新商品表
$sql = 'SELECT id,cid 
          FROM s48_goods
         WHERE status=1
         GROUP BY cid
         ORDER BY time DESC
         LIMIT 7';
$summer = array();
if($res = dbSql($sql)){
  $gid = '';
  $cid = '';
  foreach($res as $v){
    $gid .= $v['id'].',';
    $cid .= $v['cid'].',';
  }
  $gid = rtrim($gid,',');
  $cid = rtrim($cid,',');

  #查询相关联图片
  $sql = 'SELECT name img,gid 
            FROM s48_image
           WHERE gid IN('.$gid.') AND face=1';
  $img = dbSql($sql);

  #查询相关联分类
  $sql = 'SELECT id,name,pid 
            FROM s48_category
           WHERE id IN('.$cid.')';
  $cate = dbSql($sql);

  #组装所有查询数据
  $summer = arrPin($res,'id',$img,'gid');
  $summer = arrPin($summer,'cid',$cate,'id');
}

#查询浏览量最大的商品
$sql = 'SELECT g.id,i.name 
          FROM s48_goods g,s48_image i
         WHERE i.gid=g.id AND
               i.face=1
      ORDER BY `look` DESC
         LIMIT 2';
$hot = dbSql($sql);

#所有数据传入视图
display('index',$nav,$summer,$hot);