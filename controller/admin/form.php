<?php
/*
    goods控制器
    ---------------------------------------------
*/

#获取一级分类列表
end($_GET);
if(key($_GET)=='form'){
  $sql = "SELECT id,name,path,CONCAT(path,id,',') p
            FROM s48_category
           ORDER BY p ASC";
  display('form',model('dbSql',$sql));exit;
}

#添加商品
if(key($_POST) == 'add'){

  #接收数据
  unset($_POST['add']);
  list($name, $cate, $pay, $stock, $status, 
        $hot, $new, $best, $describe
  ) = array_values($_POST);
  $time = time();

  #验证输入
  if(!is_numeric($pay)){
    U('form&form',1,'商品价格只能输入数字');exit;
  }elseif(!is_numeric($stock)){
    U('form&form',1,'商品库存只能输入数字');exit;
  }

  #图片上传失败
  if(!$img = model('imgUp',$_FILES)){
    U('form&form',1,'图片上传失败');exit;
  }

  #图片100x100缩放失败
  if(!$img_100 = model('imgSize',$img,100,130)){
  unlink($img);
    U('form&form',1,'100x130图片缩放失败');exit;
  }

  #图片220x330缩放失败
  if(!$img_220 = model('imgSize',$img,220,330)){
  unlink($img);
  unlink($img_100);
    U('form&form',1,'220x330图片缩放失败');exit;
  }

  #图片400x600缩放失败
  if(!$img_400 = model('imgSize',$img,400,600)){
  unlink($img);
  unlink($img_100);
  unlink($img_220);
    U('form&form',1,'400x600图片缩放失败');exit;
  }

  #SQL语句准备
  $sql = "INSERT INTO s48_goods(name,cid,pay,
                      stock,status,hot,new,
                      best,time,decribe)
               values ('{$name}',$cate,$pay,
                      $stock,$status,$hot,$new,
                      $best,$time,'$describe')";
  #商品信息写入数据库
  if($res = model('dbSql',$sql)){

    #图片信息写入数据库           
    $sql = "INSERT INTO s48_image(name,gid,face)
                 VALUES ('{$img}',{$res},1)";
    if(model('dbSql',$sql)){
      U('form&goods',1,'添加成功');exit;

    #图片信息写失败删除所有图片和商品信息
    }else{
      unlink($img);
      unlink($img_100);
      unlink($img_220);
      unlink($img_400);
      dbSql('DELETE FROM s48_goods WHERE id='.$res);
      U('form&form',1,'添加失败');exit;
    }

  #商品信息写失败删除所有相关图片
  }else{
    unlink($img);
    unlink($img_100);
    unlink($img_220);
    unlink($img_400);
    U('form&form',1,'添加失败');exit;
  }
}

#获取商品列表
if(key($_GET)=='goods'){
  $sql = "SELECT id,name,cid,pay,stock,
                 status,hot,new,best
            FROM s48_goods
        ORDER BY time DESC";
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

#更改商品状态
if(key($_GET)=='click'){
  prev($_GET);
  $name = key($_GET);
  $val = abs($_GET[$name]-1);
  $sql = "UPDATE s48_goods SET {$name}={$val}
           WHERE id={$_GET['click']}";
  if(model('dbSql',$sql)){
    U('form&page='.$_GET['p'].'&goods');exit;
  }
}

#编辑商品
if(key($_GET)=='up'){
  $sql = "SELECT id,name,cid,pay,stock,decribe
            FROM s48_goods
           WHERE id={$_GET['up']}";
  $res = model('dbSql',$sql);
  $sql = "SELECT id,name,path,CONCAT(path,id,',') p
          FROM s48_category
         ORDER BY p ASC";
  $select = dbSql($sql);
  display('reform',$select,$res[0]);
}

#提交修改
if(key($_POST)=='update'){
  unset($_POST['update']);
  $val = array_values($_POST);
  list($id,$name,$cid,$pay,$stock,$decribe) = $val;
  $sql = "UPDATE s48_goods 
             SET name='{$name}',
                 cid={$cid},
                 pay={$pay},
                 stock='{$stock}',
                 decribe='{$decribe}'
           WHERE id={$id}";
  if(model('dbSql',$sql)){
    U('form&goods',1,'修改成功');exit;
  }else{
    U('form&goods',1,'修改失败');exit;
  }
}

#商品删除
if(key($_GET)=='delete'){
  if($_SESSION['admin']['role']<2){
    U('form&goods',1,'权限不够');exit;
  }
  $sql = "DELETE FROM s48_goods WHERE id={$_GET['delete']}";
  $res = model('dbSql',$sql);
  $sql = "SELECT name FROM s48_image WHERE gid={$_GET['delete']}";
  if($img = model('dbSql',$sql)){
    foreach($img as $n){
      $name = basename($n['name']);
      $dir = dirname($n['name']);
      $img1 = $dir.'/'.'100_'.$name;
      $img2 = $dir.'/'.'220_'.$name;
      $img3 = $dir.'/'.'400_'.$name;
      unlink($n['name']);
      unlink($img1);
      unlink($img2);
      unlink($img3);
    }
  }
  $sql = "DELETE FROM s48_image WHERE gid={$_GET['delete']}";
  dbSql($sql);
  U('form&goods',1,'删除成功');exit;
}