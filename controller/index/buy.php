<?php
/*
    订单控制器
    ------------------------------------------------
*/

#订单列表
end($_GET);
if(key($_GET)=='list'){
  if(empty($_SESSION['car'])){
    U('index',3,'您还没购买任何商品!去选购吧');exit;
  }
  if(empty($_SESSION['index'])){
    U('url&d=login',1,'请登录');exit;
  }
  $sql = 'SELECT points 
            FROM s48_user 
           WHERE id='.$_SESSION['index']['id'];
  $mgb = model('dbSql',$sql);
  $_SESSION['index']['points'] = $mgb[0]['points'];
  display('buy',$_SESSION['car'],'car');exit;
}

#确认订单信息
if(key($_GET)=='pay'){
  if(empty($_SESSION['index'])){
    U('url&d=login',1,'请登录');exit;
  }
  $num = date('YmdHis').mt_rand(0,999).$_SESSION['index']['id'].mt_rand(0,9999);
  $name = $_POST['name'];
  $add = htmlentities($_POST['province'].$_POST['city'].$_POST['area'].$_POST['street']);
  $tel = $_POST['mobile'];
  $post = $_POST['postcode'];
  $uid = $_SESSION['index']['id'];
  $pay = $_SESSION['index']['pay'];
  $mess = $_POST['beizhu'];
  if($name==''||$tel==''||$add==''){
    U($_SERVER['HTTP_REFERER'],3,'请填写完整收获信息');exit;
  }
  $sql = "INSERT INTO s48_order (`num`,`name`,`add`,`tel`,`post`,`uid`,`pay`,`mess`)
               values ('{$num}','{$name}','{$add}','{$tel}',{$post},{$uid},{$pay},'{$mess}')";
  if(!$id = model('dbSql',$sql)){
    U($_SERVER['HTTP_REFERER'],3,'收货信息填写有误');exit;
  }
  if($_GET['pay']=='car') $pay = $_SESSION['car'];
  if($_GET['pay']=='buy') $pay = $_SESSION['buy'];
  foreach($pay as $val){
    $sql = "INSERT INTO s48_order_goods(`gid`,`pay`,`num`,`oid`)
                 VALUES ({$val['id']},{$val['pay']},{$val['num']},{$id})";
    if(!dbSql($sql)){
      dbSql('DELETE FROM s48_order_goods WHERE oid='.$id);
      dbSql('DELETE FROM s48_order WHERE id='.$id);
      U($_SERVER['HTTP_REFERER'],3,'收货信息填写有误');exit;
    }
  }
  U('buylist&list',1,'订单提交成功');
  $_SESSION['index']['points'] -= $_SESSION['index']['mgb'];
  $sql = 'UPDATE s48_user 
             SET points=points-'.$_SESSION['index']['mgb'].'
           WHERE id='.$_SESSION['index']['id'];
  dbSql($sql);
  if($_GET['pay']=='car') unset($_SESSION['car']);exit;
  if($_GET['pay']=='buy') unset($_SESSION['buy']);exit;
}

#立即购买
if(key($_GET)=='buy'){
  if(empty($_SESSION['index'])){
    U('url&d=login',1,'请登录');exit;
  }
  $sql = 'SELECT points 
            FROM s48_user 
           WHERE id='.$_SESSION['index']['id'];
  $mgb = model('dbSql',$sql);
  $_SESSION['index']['points'] = $mgb[0]['points'];
  $sql = 'SELECT id,name,pay,stock 
            FROM s48_goods 
           WHERE id='.$_GET['id'];
  $goods = model('dbSql',$sql);
  $sql = 'SELECT name FROM s48_image 
                     WHERE gid='.$_GET['id'].' AND 
                           face=1';
  $img = dbSql($sql)[0]['name'];
  $img = dirname($img).'/100_'.basename($img);
  $goods[0]['num'] = $_GET['buy'];
  $goods[0]['img'] = $img;
  unset($_SESSION['buy']);
  $_SESSION['buy'][$_GET['id']] = $goods[0];
  display('buy',$_SESSION['buy'],'buy');exit;
}

#蘑菇币抵用
if(key($_GET)=='jia'){
  $_SESSION['index']['mgb'] = $_SESSION['index']['mgb'] + 1;
  if($_SESSION['index']['mgb'] > $_SESSION['index']['points']){
    $_SESSION['index']['mgb'] = $_SESSION['index']['points'];
  }
}
if(key($_GET)=='jian'){
  $_SESSION['index']['mgb'] = $_SESSION['index']['mgb'] - 1;
  if($_SESSION['index']['mgb'] < 0) $_SESSION['index']['mgb'] = 0;
}
