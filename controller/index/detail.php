<?php
/*
    商品详情
    -----------------------------------------------
*/

#商品详情
end($_GET);
if(key($_GET)=='detail'){
  $sql = 'UPDATE s48_goods
             SET `look`=`look`+1 
           WHERE id='.$_GET['detail'];
  model('dbSql',$sql);
  $sql = 'SELECT id,name,pay,stock,decribe,`out`,`look`
            FROM s48_goods
           WHERE id='.$_GET['detail'];
  $goods = model('dbSql',$sql);
  $sql = 'SELECT name,face 
            FROM s48_image 
           WHERE gid='.$_GET['detail'].'
        ORDER BY face DESC';
  $img = dbSql($sql);
  $sql = 'SELECT g.id,g.name,g.pay,i.name img
            FROM s48_goods g,s48_image i
           WHERE i.gid=g.id AND i.face=1 
        ORDER BY g.look DESC
           LIMIT 5';
  $hot = dbSql($sql);
  $sql = 'SELECT u.name,
                 d.uid,
                 d.gid,
                 d.time,
                 d.discuss
            FROM s48_user u,
                 s48_discuss d
           WHERE d.gid='.$_GET['detail'].' AND
                 d.uid=u.id AND
                 d.lock=0
        GROUP BY d.time DESC';
  $disc = dbSql($sql);
  display('detail',$goods,$img,$hot,$disc);
}