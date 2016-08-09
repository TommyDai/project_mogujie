<?php
/*
    登录注册验证函数
    -------------------------------------------------
    @auther  Tommy Dai
    -------------------------------------------------
    @parem   $name     string    用户名
    -------------------------------------------------
    @parem   $pwd      string    密码
    -------------------------------------------------
    @parem   $repwd    string    确认密码
    -------------------------------------------------
    @return  string   如果验证失败返回错误提示
    -------------------------------------------------
*/

function checkUser($name,$pwd=null,$repwd=null){

  #验证用户名
  if(!empty($name)){

    #验证用户名长度
    $tips = '用户名长度应为 6 到 16 个字符,字母数字下划线组成,以字母开头!';
    if(strlen($name)<6 || strlen($name)>16){
      return $tips;
    }

    #验证用户名格式
    $preg = '/^[a-zA-Z]\w*$/';
    if(!preg_match_all($preg,$name)){
      return $tips;
    }
  }else{
    return '请输入用户名!';
  }

  #验证密码
  if(!empty($pwd)){

    #验证密码长度
    if(strlen($pwd)<8 || strlen($pwd)>16){
      return '密码过长或过短!密码长度必须是 8 到 16 个字符';
    }

    #验证两次密码是否一致
    if(!empty($repwd)){
      if($pwd != $repwd){
        return '两次输入的密码不一致!';
      }
    }
  }else{
    return '请输入密码!';
  }
}