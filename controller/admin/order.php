<?php
/*
    订单管理
    ----------------------------------------------------------
*/

#订单列表
end($_GET);
if(key($_GET)=='list'){
  $sql = 'SELECT id,num,name,`add`,tel,`post`,uid,pay,status
            FROM s48_order
        ORDER BY status';
  $res = model('dbSql',$sql);
  $page = model('page',count($res),5);
  $sql .= ' '.$page['limit'];
  $order = dbSql($sql);
  display('order',$order,$page);
}

#订单详情
if(key($_GET)=='select'){
  $id = $_GET['select'];
  $sql = "SELECT o.id,
                 o.num no,
                 o.pay total,
                 o.status,
                 o.mess,
                 x.pay,
                 x.num,
                 i.name img,
                 g.name,
                 g.id gid,
                 u.name user
            FROM s48_order o,
                 s48_order_goods x,
                 s48_image i,
                 s48_goods g,
                 s48_user u
           WHERE o.id={$id} AND
                 x.oid=o.id AND
                 x.gid=g.id AND
                 i.gid=x.gid AND
                 o.uid=u.id AND
                 i.face=1";
  $goods = (model('dbSql',$sql));
  display('detail',$goods);
}

#发货
if(key($_GET)=='send'){
  if($_GET['s']>2){
    U($_SERVER['HTTP_REFERER'],1,'该商品已发货');exit;
  }
  if($_GET['s']<2){
    U($_SERVER['HTTP_REFERER'],1,'未付款不能发货');exit;
  }
  $sql = 'UPDATE s48_order 
             SET status=3
           WHERE id='.$_GET['send'];
  model('dbSql',$sql);
  U($_SERVER['HTTP_REFERER'],1,'发货成功');exit;
}

#删除订单
if(key($_GET)=='delete'){
  if($_SESSION['admin']['role']<2){
    U($_SERVER['HTTP_REFERER'],1,'权限不够');exit;
  }
  if($_GET['s']>1){
    U($_SERVER['HTTP_REFERER'],1,'只能删除未付款订单');exit;
  }
  $sql = 'DELETE FROM s48_order WHERE id='.$_GET['delete'];
  if(model('dbSql',$sql)){
    U($_SESSION['U'],1,'删除成功');exit;
  }
}