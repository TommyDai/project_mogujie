<?php
/*
    积分管理
    --------------------------------------------------
*/

#积分列表
end($_GET);
if(key($_GET)=='list'){
  $sql = 'SELECT id,name,points,img
            FROM s48_user 
           WHERE points>0
        ORDER BY points DESC';
  $res = model('dbSql',$sql);
  display('points',$res);
}

#积分清零
if(key($_GET)=='del'){
  if($_SESSION['admin']['role']<2){
    U('points&list',1,'权限不够');exit;
  }
  $sql = 'UPDATE s48_user SET points=0 WHERE id='.$_GET['del'];
  model('dbSql',$sql);
  U('points&list');
}