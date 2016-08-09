<?php
/*
    用户评论
    -----------------------------------------------
*/

#评论列表
end($_GET);
if(key($_GET)=='list'){
  $sql = 'SELECT d.id,
                 d.discuss,
                 d.time,
                 u.name user,
                 g.name goods,
                 i.name img
            FROM s48_discuss d,
                 s48_user u,
                 s48_goods g,
                 s48_image i
           WHERE d.uid=u.id AND
                 d.gid=g.id AND
                 i.gid=g.id AND
                 i.face=1
        ORDER BY d.time DESC';
  $res = model('dbSql',$sql);
  $page = model('page',count($res),5);
  $sql .= ' '.$page['limit'];
  $res = dbSql($sql);
  display('discuss',$res,$page);
}

#回复
if(key($_GET)=='formdis'){
  display('formdis',$_GET['formdis']);
}
if(key($_GET)=='reply'){
  $text = '<br/>[回复]:'.$_POST['text'];
  $sql = "UPDATE s48_discuss 
             SET discuss=concat(discuss,'{$text}') 
           WHERE id={$_GET['reply']}";
  if(model('dbSql',$sql)){
    U('discuss&list',1,'回复成功');exit;
  }
}

#删除评论
if(key($_GET)=='del'){
  if($_SESSION['admin']['role']<2){
    U($_SERVER['HTTP_REFERER'],1,'权限不够');exit;
  }
  $sql = 'DELETE FROM s48_discuss
                WHERE id='.$_GET['del'];
  if(model('dbSql',$sql)){
    U($_SERVER['HTTP_REFERER'],1,'删除成功');exit;
  }
}