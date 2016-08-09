<?php
/*
    购物车控制器
    ----------------------------------------------
*/

#商品信息加入购物车
end($_GET);
if(key($_GET)=='add'){
  if(!empty($_SESSION['car'][$_GET['id']])){
    $_SESSION['car'][$_GET['id']]['num'] += $_GET['add'];
    U('detail&detail='.$_GET['id']);exit;
  }
  $sql = 'SELECT id,name,pay,stock 
            FROM s48_goods 
           WHERE id='.$_GET['id'];
  $goods = model('dbSql',$sql);
  $sql = 'SELECT name FROM s48_image 
                     WHERE gid='.$_GET['id'].' AND 
                           face=1';
  $img = dbSql($sql)[0]['name'];
  $img = dirname($img).'/100_'.basename($img);
  $goods[0]['num'] = $_GET['add'];
  $goods[0]['img'] = $img;
  $_SESSION['car'][$_GET['id']] = $goods[0];
  U('detail&detail='.$_GET['id']);exit;
}

#购物车详情
if(key($_GET)=='list'){
  $car = empty($_SESSION['car']) ? null : $_SESSION['car'];
  display('mycart',$car);
}

#增加数量
if(key($_GET)=='up'){
  ++$_SESSION['car'][$_GET['up']]['num'];
  if($_SESSION['car'][$_GET['up']]['num']>=$_SESSION['car'][$_GET['up']]['stock']){
    $_SESSION['car'][$_GET['up']]['num']=$_SESSION['car'][$_GET['up']]['stock'];
  }
  U('car&list');exit;
}

#减少数量
if(key($_GET)=='down'){
  --$_SESSION['car'][$_GET['down']]['num'];
  if($_SESSION['car'][$_GET['down']]['num']<=0){
    $_SESSION['car'][$_GET['down']]['num']=1;
  }
  U('car&list');exit;
}

#删除购物车商品
if(key($_GET)=='del'){
  unset($_SESSION['car'][$_GET['del']]);
  U('car&list');exit;
}