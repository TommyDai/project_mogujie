<?php
/*
    后台用户操作
    -------------------------------------------
*/

#验证GET请求
if(!empty($_GET['action']) && $_GET['action']==$_SESSION['rand']){

  #处理锁定操作
  if(isset($_GET['lock'])){
    $lock = abs($_GET['lock']-1);
    $sql = "UPDATE s48_user 
               SET `lock`={$lock} 
             WHERE id={$_GET['id']}";
    model('dbSql',$sql);
  }

  #处理编辑操作
  if(!empty($_GET['update'])){
    $id = $_GET['update'];
    $sql = "SELECT id,name,role,`lock` 
              FROM s48_user 
             WHERE id={$id}";
    $res = model('dbSql',$sql);
    display('userupdate',$res);
  }

  #处理删除操作
  if(!empty($_GET['delete'])){
    if($_SESSION['admin']['role']<2){
      U($_SERVER['HTTP_REFERER'],1,'权限不够');exit;
    }
    $id = $_GET['delete'];
    $sql = "DELETE FROM s48_user WHERE id={$id}";
    model('dbSql',$sql);
  }
}

#分页计算
$sql = 'SELECT id,name,role,`lock` 
          FROM s48_user 
         WHERE role<'.$_SESSION['admin']['role'].'
      ORDER BY role DESC';
$res = model('dbSql',$sql);
$page = model('page',count($res),10);

#分页查询
$sql .= ' '.$page['limit'];
$res = dbSql($sql);

#数据传入视图
display('right',$res,$page,randStr());