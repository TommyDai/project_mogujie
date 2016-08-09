<?php
/*
    前台搜索控制器
    --------------------------------------------
*/

#商品搜索
end($_GET);
if(key($_GET)=='search'){
  $sql = "SELECT id,name,pay,hot,new,best,`look`
            FROM s48_goods
           WHERE status = 1 AND
                 name LIKE '%{$_GET['search']}%'";
  $res = model('dbSql',$sql);
  $page = model('page',count($res),50);
  $sql .= ' '.$page['limit'];
  if($res = dbSql($sql)){
    $arr = array();
    foreach($res as $v){
      $sql = "SELECT name 
                FROM s48_image 
               WHERE gid={$v['id']} AND
                     face=1";
      $v['img'] = dbSql($sql)[0]['name'];
      $arr[] = $v;
    }
    display('search',$arr,$page);exit;
  }else{
    U('index',3,'啊哦！没有找到您找的宝贝,去首页逛逛吧!');exit;
  }
}

#二级分类商品
if(key($_GET)=='nav'){
  $sql = "SELECT id,name,pay,hot,new,best,`look`
            FROM s48_goods
           WHERE cid={$_GET['nav']}";
  $res = model('dbSql',$sql);
  $page = model('page',count($res),50);
  $sql .= ' '.$page['limit'];
  if($res = dbSql($sql)){
    $arr = array();
    foreach($res as $v){
      $sql = "SELECT name 
                FROM s48_image 
               WHERE gid={$v['id']} AND
                     face=1";
      $v['img'] = dbSql($sql)[0]['name'];
      $arr[] = $v;
    }
    display('search',$arr,$page);exit;
  }else{
    U('index');exit;
  }
}

#一级分类商品
if(key($_GET)=='cate'){
  $sql = 'SELECT id FROM s48_category 
                   WHERE pid='.$_GET['cate'];
  $res = model('dbSql',$sql);
  $id = '';
  foreach($res as $val){
    $id .= $val['id'].',';
  }
  $id = rtrim($id,',');
  $sql = "SELECT id,name,pay,hot,new,best,`look`
            FROM s48_goods
           WHERE cid IN({$id})";
  $res = model('dbSql',$sql);
  $page = model('page',count($res),50);
  $sql .= ' '.$page['limit'];
  if($res = dbSql($sql)){
    $arr = array();
    foreach($res as $v){
      $sql = "SELECT name 
                FROM s48_image 
               WHERE gid={$v['id']} AND
                     face=1";
      $v['img'] = dbSql($sql)[0]['name'];
      $arr[] = $v;
    }
    display('search',$arr,$page);exit;
  }else{
    U('index');exit;
  }
}