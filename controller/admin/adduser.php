<?php
/*
    后台用户添加和修改
    --------------------------------------
*/

#无数据提交返回
if(empty($_POST)){
  display('login');exit;
}

#验证用户名密码
$repwd = isset($_POST['repwd']) ? $_POST['repwd'] : null;
if($tips = model('checkUser',$_POST['name'],$_POST['pwd'],$repwd)){
  U('userlist',1,$tips);exit;
}

#准备SQL语句
$id = isset($_POST['id']) ? $_POST['id'] : null;
$user = htmlentities(trim($_POST['name'],' '));
$pwd = md5(trim($_POST['pwd'],' '));
if(!empty($repwd)){
  $sql = "INSERT INTO s48_user(name,password,role)
               VALUES ('{$user}','{$pwd}',{$_POST['role']})";
}else{
  $sql = "UPDATE s48_user 
             SET name='{$user}',password='{$pwd}',role={$_POST['role']}
           WHERE id={$id}";
}

#写入数据库
if($res = model('dbSql',$sql)){

  #修改成功
  U('userlist',1,'SUCCESS!');
}else{
  U('userlist',1,'ERROR!');
}