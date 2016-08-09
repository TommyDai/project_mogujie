<?php
/*
    后台搜索控制器
    --------------------------------------
*/

#用户名搜索
end($_GET);
if(key($_GET) == 'right'){
  if(!empty($_GET['right'])){

    #准备查询语句
    $role = $_SESSION['admin']['role'];
    $sql = "SELECT id,name,role,`lock`
              FROM s48_user
             WHERE name LIKE '%{$_GET['right']}%'";

    #分页查询
    $res = model('dbSql',$sql);
    $page = model('page',count($res),10);
    $sql .= ' '.$page['limit'];
    $res = dbSql($sql);

    #数据传入视图
    display('right',$res,$page,randStr());exit;
  }else{
    U('userlist',1,'请输入查询内容!');exit;
  }
}

#分类名称或PID搜索
reset($_POST);
if(key($_POST)=='category'){
  $sql = "SELECT id,name,pid,path,display 
            FROM s48_category 
           WHERE name LIKE '%{$_POST['category']}%'
              OR pid LIKE '%{$_POST['category']}%'";
  $res = model('dbSql',$sql);
  display('tab',$res,randStr());exit;
}

#商品搜索
if(key($_GET)=='search'){
  $sql = "SELECT id,name,cid,pay,stock,
                 status,hot,new,best
            FROM s48_goods
           WHERE name LIKE '%{$_GET['search']}%' OR
                 pay LIKE '%{$_GET['search']}%' OR
                 stock LIKE '%{$_GET['search']}%'";
  if($res = model('dbSql',$sql)){
    $page = model('page',count($res),5);
    $sql .= ' '.$page['limit'];
    $res = model('dbSql',$sql);
    $arr = array();
    foreach($res as $val){
      $cate = "SELECT name FROM s48_category WHERE id={$val['cid']}";
      $val['cate'] = dbSql($cate)[0]['name'];
      $img = "SELECT name FROM s48_image WHERE gid={$val['id']} AND face=1";
      $val['img'] = dbSql($img)[0]['name'];
      $arr[] = $val;
    }
    display('imglist1',$arr,$page);
  }else{
    U('url&d=imglist1',1,'没有数据');exit;
  }
}

#订单模糊搜索
if(key($_GET)=='order'){
  $sql = "SELECT id,num,name,`add`,tel,`post`,uid,pay,status
            FROM s48_order
           WHERE num LIKE '%{$_GET['order']}%' 
              OR name LIKE '%{$_GET['order']}%'
              OR `add` LIKE '%{$_GET['order']}%'
              OR tel LIKE '%{$_GET['order']}%'";
  $res = model('dbSql',$sql);
  $page = model('page',count($res),5);
  $sql .= ' '.$page['limit'];
  $order = dbSql($sql);
  display('order',$order,$page);
}

#查询待发货商品
if(key($_GET)=='wait'){
  $sql = 'SELECT id,num,name,`add`,tel,`post`,uid,pay,status
            FROM s48_order
           WHERE status=2';
  $res = model('dbSql',$sql);
  $page = model('page',count($res),5);
  $sql .= ' '.$page['limit'];
  $order = dbSql($sql);
  display('order',$order,$page);
}

#查询评论信息
if(key($_GET)=='discuss'){
  $sql = "SELECT d.id,
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
                 i.face=1 AND (
                 d.discuss LIKE '%{$_GET['discuss']}%' OR
                 u.name LIKE '%{$_GET['discuss']}%' OR
                 g.name LIKE '%{$_GET['discuss']}%')
        ORDER BY d.time DESC";
  $res = model('dbSql',$sql);
  $page = model('page',count($res),5);
  $sql .= ' '.$page['limit'];
  $res = dbSql($sql);
  display('discuss',$res,$page);
}