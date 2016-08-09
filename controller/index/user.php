<?php
/*
    用户控制器
    -------------------------------------------
*/

#个人信息
end($_GET);
if(key($_GET)=='info'){
  $sql = 'SELECT name,img 
            FROM s48_user 
           WHERE id='.$_SESSION['index']['id'];
  $res = model('dbSql',$sql);
  display('userinfo',$res);
}

#修改密码
if(key($_GET)=='repwd'){
  if($tips = model('checkUser',$_SESSION['index']['name'],$_GET['repwd'])){
    U($_SERVER['HTTP_REFERER'],1,$tips);exit;
  }
  $pwd = md5($_GET['repwd']);
  $sql = "UPDATE s48_user 
             SET password='{$pwd}'  
           WHERE id={$_SESSION['index']['id']}";
  if($res = model('dbSql',$sql)){
    unset($_SESSION['index']);
    U('login',1,'密码修改成功 请重新登陆');exit;
  }else{
    U($_SERVER['HTTP_REFERER'],1,'修改失败');exit;
  }
}

#AJAX提交验证原始密码
if(key($_GET)=='pwd'){
  $pwd = md5($_POST['val']);
  $sql = "SELECT password 
            FROM s48_user 
           WHERE id={$_SESSION['index']['id']} 
             AND password='{$pwd}'";
  if(model('dbSql',$sql)){
    exit('true');
  }else{
    exit('false');
  }
}

#修改头像
if(key($_GET)=='head'){
  $sql = 'SELECT img 
            FROM s48_user 
           WHERE id='.$_SESSION['index']['id'];
  if($head = model('dbSql',$sql)){
    $img = dirname($head[0]['img']).'/100_'.basename($head[0]['img']);
    unlink($img);
  }
  $img = model('imgUp',$_FILES);
  model('imgSize',$img,100,120);
  unlink($img);
  $sql = "UPDATE s48_user 
             SET img='{$img}' 
           WHERE id={$_SESSION['index']['id']}";
  if(dbSql($sql)){
    U($_SERVER['HTTP_REFERER'],1,'修改成功');exit;
  }
  U($_SERVER['HTTP_REFERER'],1,'修改失败');exit;
}