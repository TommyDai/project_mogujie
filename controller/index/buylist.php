<?php
/*
    订单控制器
    --------------------------------------------------
*/

#订单列表
end($_GET);
if(key($_GET)=='list'){
  if(empty($_SESSION['index'])){
    U('url&d=login',1,'请登录');exit;
  }
  $id = $_SESSION['index']['id'];
  $sql = "SELECT o.id,
                 o.num no,
                 o.pay total,
                 o.status,
                 x.pay,
                 x.num,
                 x.dis,
                 i.name img,
                 g.name,
                 g.id gid
            FROM s48_order o,
                 s48_order_goods x,
                 s48_image i,
                 s48_goods g
           WHERE o.uid={$id} AND
                 x.oid=o.id AND
                 x.gid=g.id AND
                 i.gid=x.gid AND
                 i.face=1";
  $goods = (model('dbSql',$sql));
  $sql = 'SELECT id FROM s48_order WHERE uid='.$id;
  $page = model('page',count(dbSql($sql)),5);
  $sql .= ' ORDER BY id DESC '.$page['limit'];
  if($order = dbSql($sql)){
    $order = array_chunk($order,1);
    foreach($order as $val){
      $orders[] = arrPin($val,'id',$goods,'id');
    }
  }
  display('buylist',$orders,$page);
}

#付款
if(key($_GET)=='pay'){
  $sql = 'UPDATE s48_order 
             SET status=2 
           WHERE id='.$_GET['pay'];
  if(model('dbSql',$sql)){
    $sql = 'SELECT gid,num 
              FROM s48_order_goods 
             WHERE oid='.$_GET['pay'];
    $or_goods = dbSql($sql);
    foreach($or_goods as $val){
      $sql = 'UPDATE s48_goods 
                 SET `out`=`out`+'.$val['num'].',
                     stock=stock-'.$val['num'].'
               WHERE id='.$val['gid'];
      dbSql($sql);
    }
    U('buylist&list',1,'付款成功');exit;
  }
}

#退货
if(key($_GET)=='back'){
  $sql = 'UPDATE s48_order 
             SET status=1 
           WHERE id='.$_GET['back'];
  if(model('dbSql',$sql)){
    $sql = 'SELECT gid,num 
              FROM s48_order_goods 
             WHERE oid='.$_GET['back'];
    $or_goods = dbSql($sql);
    foreach($or_goods as $val){
      $sql = 'UPDATE s48_goods 
                 SET `out`=`out`-'.$val['num'].',
                     stock=stock+'.$val['num'].'
               WHERE id='.$val['gid'];
      dbSql($sql);
    }
    U('buylist&list',1,'退款成功');exit;
  }
}


#确认收货
if(key($_GET)=='receive'){
  $sql = 'UPDATE s48_order 
             SET status=4 
           WHERE id='.$_GET['receive'];
  model('dbSql',$sql);
  $p = floor($_GET['p']/10);
  $sql = 'UPDATE s48_user
             SET points=points+'.$p.'
           WHERE id='.$_SESSION['index']['id'];
  if(dbSql($sql)){
    U($_SERVER['HTTP_REFERER'],2,'亲!恭喜您获得 '.$p.' 蘑菇币');exit;
  }
  U($_SERVER['HTTP_REFERER']);exit;
}

#显示评价表单
if(key($_GET)=='ass'){
  if(empty($_SESSION['index'])){
    U('url&d=login',1,'请登录');exit;
  }
  $sql = "SELECT o.id,
                 o.num no,
                 o.pay total,
                 o.status,
                 x.pay,
                 x.num,
                 x.dis,
                 i.name img,
                 g.name,
                 g.id gid
            FROM s48_order o,
                 s48_order_goods x,
                 s48_image i,
                 s48_goods g
           WHERE g.id={$_GET['ass']} AND
                 x.oid={$_GET['oid']} AND
                 x.oid=o.id AND
                 x.gid=g.id AND
                 i.gid=x.gid AND
                 i.face=1
        GROUP BY g.id";
  $goods = (model('dbSql',$sql));
  $orders[] = $goods;
  display('buylist',$orders,null,$_GET['ass']);
}

#用户评价
if(key($_GET)=='mess'){
  $sql = "INSERT INTO s48_discuss(uid,gid,time,discuss)
               VALUES ({$_SESSION['index']['id']},
                      {$_GET['mess']},
                      ".time().",
                      '{$_POST['mess']}')";
  if(model('dbSql',$sql)){
    $sql = 'UPDATE s48_order_goods
               SET dis=1
             WHERE gid='.$_GET['mess'].' AND
                   oid='.$_GET['oid'];
    dbSql($sql);
  }
  $sql = 'SELECT id 
            FROM s48_order_goods
           WHERE oid='.$_GET['oid'].' AND
                 dis=0';
  if(!dbSql($sql)){
    $sql = 'UPDATE s48_order
               SET status=5
             WHERE id='.$_GET['oid'];
    dbSql($sql);
  }
  U('buylist&list',2,'评论成功');exit;
}

#删除订单
if(key($_GET)=='delete'){
  if($_GET['s']>1){
    U($_SERVER['HTTP_REFERER'],1,'只能删除未付款订单');exit;
  }
  $sql = 'DELETE FROM s48_order WHERE id='.$_GET['delete'];
  if(model('dbSql',$sql)){
    U($_SERVER['HTTP_REFERER'],1,'删除成功');exit;
  }
}

#未付款订单
if(key($_GET)=='nopay'){
  if(empty($_SESSION['index'])){
    U('url&d=login',1,'请登录');exit;
  }
  $id = $_SESSION['index']['id'];
  $sql = "SELECT o.id,
                 o.num no,
                 o.pay total,
                 o.status,
                 x.pay,
                 x.num,
                 x.dis,
                 i.name img,
                 g.name,
                 g.id gid
            FROM s48_order o,
                 s48_order_goods x,
                 s48_image i,
                 s48_goods g
           WHERE o.uid={$id} AND
                 x.oid=o.id AND
                 x.gid=g.id AND
                 i.gid=x.gid AND
                 o.status=1 AND
                 i.face=1";
  $goods = (model('dbSql',$sql));
  $sql = 'SELECT id FROM s48_order WHERE uid='.$id.' AND status=1';
  $page = model('page',count(dbSql($sql)),5);
  $sql .= ' ORDER BY id DESC '.$page['limit'];
  if($order = dbSql($sql)){
    $order = array_chunk($order,1);
    foreach($order as $val){
      $orders[] = arrPin($val,'id',$goods,'id');
    }
  }
  display('buylist',$orders,$page);
}

#待发货订单
if(key($_GET)=='waitsh'){
  if(empty($_SESSION['index'])){
    U('url&d=login',1,'请登录');exit;
  }
  $id = $_SESSION['index']['id'];
  $sql = "SELECT o.id,
                 o.num no,
                 o.pay total,
                 o.status,
                 x.pay,
                 x.num,
                 x.dis,
                 i.name img,
                 g.name,
                 g.id gid
            FROM s48_order o,
                 s48_order_goods x,
                 s48_image i,
                 s48_goods g
           WHERE o.uid={$id} AND
                 x.oid=o.id AND
                 x.gid=g.id AND
                 i.gid=x.gid AND
                 o.status=3 AND
                 i.face=1";
  $goods = (model('dbSql',$sql));
  $sql = 'SELECT id FROM s48_order WHERE uid='.$id.' AND status=3';
  $page = model('page',count(dbSql($sql)),5);
  $sql .= ' ORDER BY id DESC '.$page['limit'];
  if($order = dbSql($sql)){
    $order = array_chunk($order,1);
    foreach($order as $val){
      $orders[] = arrPin($val,'id',$goods,'id');
    }
  }
  display('buylist',$orders,$page);
}

#待评价
if(key($_GET)=='waitdis'){
  if(empty($_SESSION['index'])){
    U('url&d=login',1,'请登录');exit;
  }
  $id = $_SESSION['index']['id'];
  $sql = "SELECT o.id,
                 o.num no,
                 o.pay total,
                 o.status,
                 x.pay,
                 x.num,
                 x.dis,
                 i.name img,
                 g.name,
                 g.id gid
            FROM s48_order o,
                 s48_order_goods x,
                 s48_image i,
                 s48_goods g
           WHERE o.uid={$id} AND
                 x.oid=o.id AND
                 x.gid=g.id AND
                 i.gid=x.gid AND
                 o.status=4 AND
                 i.face=1";
  $goods = (model('dbSql',$sql));
  $sql = 'SELECT id FROM s48_order WHERE uid='.$id.' AND status=4';
  $page = model('page',count(dbSql($sql)),5);
  $sql .= ' ORDER BY id DESC '.$page['limit'];
  if($order = dbSql($sql)){
    $order = array_chunk($order,1);
    foreach($order as $val){
      $orders[] = arrPin($val,'id',$goods,'id');
    }
  }
  display('buylist',$orders,$page);
}