<?php
/*
    后台管理员登陆
    -------------------------------------------
*/

#退出登录
end($_GET);
if(key($_GET)=='logout'){
unset($_SESSION['admin']);
U('login');exit;
}

#检测是否已登陆
if(!empty($_SESSION['admin'])){
  U('index',1,'您已登陆');exit;
}

#无数据提交返回
if(empty($_POST)){
  display('login');exit;
}

#检测用户名密码
if($tips = model('checkUser',$_POST['name'],$_POST['pwd'])){
  U('logout',1,$tips);exit;
}

#接收并处理表单数据
$name = htmlentities(trim($_POST['name'],' '));
$pwd = md5(htmlentities(trim($_POST['pwd'],' ')));

#准备验证SQL语句
$sql = "SELECT id,name,password,role,`lock` 
          FROM s48_user 
         WHERE name='{$name}' and role>0";

#进行验证
if($res = model('dbSql',$sql)){

  #验证是否锁定
  if($res[0]['lock']==1){
    U('login',3,'你被关进小黑屋了,请联系管理员!');exit;
  }

  #验证用户名
  if($res[0]['name']!=$name){
    U('login',1,'用户名错误');exit;
  }
  
  #验证密码
  if($res[0]['password']!=$pwd){
    U('login',1,'密码错误');exit;
  }

  #除密码外全部信息写入SESSION
  unset($res[0]['password']);
  $_SESSION['admin']=$res[0];

  #登录成功跳转
  $tips = $_SESSION['admin']['name'].'欢迎回来！';
  U('index',1,$tips);
}else{
  U('login',1,'用户名或密码错误!');
}