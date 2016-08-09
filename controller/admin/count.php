<?php
/*
    数据统计画图函数
    ---------------------------------------------
*/

#热销统计
end($_GET);
if(key($_GET)=='hot'){
  $sql = 'SELECT g.name,
                 g.out,
                 i.name img
            FROM s48_goods g,
                 s48_image i
           WHERE g.id=i.gid AND
                 i.face=1
        ORDER BY g.out DESC LIMIT 10';
  $res = model('dbSql',$sql);
  $num = 340/$res[0]['out'];
  $arr = array();
  foreach($res as $r){
    $r['num'] = $r['out']*$num;
    $arr[] = $r;
  }
  display('count',$arr);
}

#浏览量排行
if(key($_GET)=='look'){
  $sql = 'SELECT g.name,
                 g.look `out`,
                 i.name img
            FROM s48_goods g,
                 s48_image i
           WHERE g.id=i.gid AND
                 i.face=1
        ORDER BY g.look DESC LIMIT 10';
  $res = model('dbSql',$sql);
  $num = 340/$res[0]['out'];
  $arr = array();
  foreach($res as $r){
    $r['num'] = $r['out']*$num;
    $arr[] = $r;
  }
  display('count',$arr);
}

#用户积分排行
if(key($_GET)=='points'){
  $sql = 'SELECT name,points `out`,img
            FROM s48_user
        ORDER BY points DESC LIMIT 10';
  $res = model('dbSql',$sql);
  $num = 340/$res[0]['out'];
  $arr = array();
  foreach($res as $r){
    $r['num'] = $r['out']*$num;
    $arr[] = $r;
  }
  display('count',$arr);
}

#滞销排行
if(key($_GET)=='bad'){
  $sql = 'SELECT g.name,
                 g.stock `out`,
                 i.name img
            FROM s48_goods g,
                 s48_image i
           WHERE g.id=i.gid AND
                 i.face=1
        ORDER BY g.stock DESC LIMIT 10';
  $res = model('dbSql',$sql);
  $num = 340/$res[0]['out'];
  $arr = array();
  foreach($res as $r){
    $r['num'] = $r['out']*$num;
    $arr[] = $r;
  }
  display('count',$arr);
}