<?php
/*
    image控制器
    -----------------------------------------------
*/

#商品图片编辑
end($_GET);
if(key($_GET)=='image'){
  prev($_GET);
  $sql = "SELECT id,name,gid,face FROM s48_image WHERE gid={$_GET['image']}";
  display('image',model('dbSql',$sql),key($_GET),$_GET['image']);exit;
}

#图片上传
if(key($_GET)=='upload'){

  #图片上传失败
  if(!$img = model('imgUp',$_FILES)){
    U('image&image='.$_GET['upload'],1,'图片上传失败');exit;
  }

  #图片100x130缩放失败
  if(!$img_100 = model('imgSize',$img,100,130)){
    unlink($img);
    U('image&image='.$_GET['upload'],1,'100x130图片缩放失败');exit;
  }

  #图片220x330缩放失败
  if(!$img_220 = model('imgSize',$img,220,330)){
    unlink($img);
    unlink($img_100);
    U('image&image='.$_GET['upload'],1,'220x330图片缩放失败');exit;
  }

  #图片400x600缩放失败
  if(!$img_400 = model('imgSize',$img,400,600)){
    unlink($img);
    unlink($img_100);
    unlink($img_220);
    U('image&image='.$_GET['upload'],1,'400x600图片缩放失败');exit;
  }

  #图片信息写入数据库
  $sql = "INSERT INTO s48_image(name,gid) 
               VALUES ('{$img}',{$_GET['upload']})";
  if(model('dbSql',$sql)){
    U('image&image='.$_GET['upload'],1,'上传成功');exit;
  }else{
    unlink($img);
    unlink($img_100);
    unlink($img_220);
    unlink($img_400);
    U('image&image='.$_GET['upload'],1,'上传失败');exit;
  }
}

#更改封皮
if(key($_GET)=='face'){
  $sql = "UPDATE s48_image SET face=0 WHERE gid={$_GET['gid']}";
  model('dbSql',$sql);
  $sql = "UPDATE s48_image SET face=1 WHERE id={$_GET['face']}";
  if(dbSql($sql)){
    U('image&image='.$_GET['gid'],1,'修改成功');exit;
  }else{
    U('image&image='.$_GET['gid'],1,'修改失败');exit;
  }
}

#图片删除
if(key($_GET)=='delete'){
  if($_SESSION['admin']['role']<2){
    U('image&image='.$_GET['gid'],1,'权限不够');exit;
  }
  $sql = "SELECT name FROM s48_image WHERE id={$_GET['delete']}";
  $res = model('dbSql',$sql);
  $img1 = dirname($res[0]['name']).'/100_'.basename($res[0]['name']);
  $img2 = dirname($res[0]['name']).'/220_'.basename($res[0]['name']);
  $img3 = dirname($res[0]['name']).'/400_'.basename($res[0]['name']);
  unlink($res[0]['name']);
  unlink($img1);
  unlink($img2);
  unlink($img3);
  $sql = "DELETE FROM s48_image WHERE id={$_GET['delete']}";
  if(dbSql($sql)){
    U('image&image='.$_GET['gid'],1,'删除成功');exit;
  }else{
    U('image&image='.$_GET['gid'],1,'删除失败');exit;
  }
}