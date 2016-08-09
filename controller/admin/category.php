<?php
/*
    分类控制器
    ----------------------------------
*/

#查询一级分类
end($_GET);
if(key($_GET)=='list'){
  $sql = "SELECT id,name,pid,path,display
            FROM s48_category
           WHERE pid=0";
  if($res = model('dbSql',$sql)){
    display('tab',$res,randStr());exit;
  }else{
    display('tab');exit;
  }
}

#屏蔽浏览器地址栏恶意操作
$rand = !isset($_GET['r']) ? '' : $_GET['r'];
if(!empty($_GET) && $rand==$_SESSION['rand']){

  #查询操作
  if(key($_GET) == 'select'){

    #查询子分类
    if(!empty($_GET['select'])){
      $sql = "SELECT id,name,pid,path,display
                FROM s48_category
               WHERE pid={$_GET['select']}";
      if($res = model('dbSql',$sql)){
        display('tab',$res,randStr());exit;
      }else{
        $sql = "SELECT id,name,pid,path,display
                  FROM s48_category
                 WHERE pid=(SELECT pid 
                              FROM s48_category
                             WHERE id={$_GET['select']})";
        display('tab',model('dbSql',$sql),randStr());exit;
      }
    }
  }

  #返回上一级
  if(key($_GET)=='back'){
    $sql = "SELECT id,name,pid,path,display
              FROM s48_category
             WHERE pid=(SELECT pid 
                          FROM s48_category 
                         WHERE id={$_GET['back']})";
    if($res = model('dbSql',$sql)){
      display('tab',$res,randStr());exit;
    }
  }

  #添加子分类
  if(key($_GET)=='add'){
    $sql = "SELECT id,pid,path 
              FROM s48_category 
             WHERE id={$_GET['add']}";
    if($res = model('dbSql',$sql)){
      display('filelist',$res);exit;
    }
  }

  #编辑分类
  if(key($_GET)=='update'){
    $sql = "SELECT id,name,pid,path 
              FROM s48_category 
             WHERE id={$_GET['update']}";
    if($res = model('dbSql',$sql)){
      display('updatelist',$res);exit;
    }
  }

  #删除分类
  if(key($_GET)=='delete'){
    if($_SESSION['admin']['role']<2){
      U('category&list',1,'权限不够,请联系超级管理员!');exit;
    }
    $sql = "SELECT id FROM s48_category 
                     WHERE pid={$_GET['delete']}";
    if(model('dbSql',$sql)){
      U('category&list',1,'必须删除所有子分类才能操作!');exit;
    }else{
      $sql = "DELETE FROM s48_category 
                    WHERE id={$_GET['delete']}";
      if($res = model('dbSql',$sql)){
        U('category&list');exit;
      }
    }
  }

  #修改是否醒目
  if(key($_GET)=='display'){
    $dis = abs($_GET['display']-1);
    $sql = "UPDATE s48_category 
               SET display={$dis}
             WHERE id={$_GET['id']}";
    model('dbSql',$sql);
    $sql = "SELECT id,name,pid,path,display
              FROM s48_category
             WHERE pid=(SELECT pid 
                          FROM s48_category 
                         WHERE id={$_GET['id']})";
    display('tab',model('dbSql',$sql),randStr());exit;
  }
}

#修改操作
if(key($_GET) == 'update'){
  if(!empty($_POST['name'])){
    $sql = "UPDATE s48_category 
               SET name='{$_POST['name']}',
                   display={$_POST['display']}
             WHERE id={$_POST['id']}";
    if(model('dbSql',$sql)){
      U('category&list',1,'修改成功');exit;
    }else{
      U('category&list',1,'无修改');exit;
    }
  }else{
    U('category&list',1,'请输入分类名称');exit;
  }
}

#添加操作
reset($_POST);
if(key($_POST) == 'insert'){
  if(!empty($_POST['name'])){
    $sql = "INSERT INTO s48_category(name,pid,path,display)
                 VALUES ('{$_POST['name']}',
                        {$_POST['pid']},
                        '{$_POST['path']}',
                        {$_POST['display']})";
    if(model('dbSql',$sql)){
      $sql = "SELECT id,name,pid,path,display
                FROM s48_category
               WHERE pid={$_POST['pid']}";
      display('tab',model('dbSql',$sql),randStr());exit;
    }
  }else{
    U('url&d=filelist',1,'请输入分类名称');exit;
  }
}