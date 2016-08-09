<?php
/*
    用户注册
    --------------------------------------
*/

#空数据返回
if(empty($_POST)){
  display('register');exit;
}else{
  $user = $_POST['user'];
  $pwd = $_POST['pwd'];
  $repwd = $_POST['repwd'];
  $code = strtoupper($_POST['code']);
  $recode = strtoupper($_SESSION['code']);
}

#检测用户名密码
if($tips = model('checkUser',$user,$pwd,$repwd)){
  U('reg',2,$tips);exit; 
}

#验证码
if(!empty($code)){
  if($code != $recode){
    U('reg',2,'验证码错误!');exit;
  }
}else{
  U('reg',2,'请输入验证码!');exit;
}

#准备SQL语句
$user = htmlentities(trim($user,' '));
$pwd = md5(trim($pwd,' '));
$sql = "INSERT INTO s48_user(name,password) VALUES('{$user}','{$pwd}')";

#写入数据库
if($res = model('dbSql',$sql)){

  #准备验证SQL语句
  $sql = 'SELECT id,name,password,role,`lock` 
            FROM s48_user 
           WHERE id='.$res;
  $res = model('dbSql',$sql);

  #除密码外全部信息写入SESSION
  unset($res[0]['password']);
  $_SESSION['index']=$res[0];

  #注册跳转
  $tips = $_SESSION['index']['name'].'注册成功-欢迎使用';
  U($_SESSION['U'],1,$tips);exit;
}else{
  U('reg',2,'该用户名已被使用,请重新注册!');
}