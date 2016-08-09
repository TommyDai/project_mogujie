<?php
/*
    数据库操作
    ------------------------------------------------
    @auther Tommy Dai  
    ------------------------------------------------
    @parem  $sql   string   sql语句
    ------------------------------------------------
    @return    查返回数组   增删改返回字符串
    ------------------------------------------------
*/

function dbSql($sql,$close=null){

  #数据库连接
  $link = $GLOBALS['link'];

  #处理SELECT操作
  if(substr($sql,0,6)=='SELECT'){

    #发送SELECT语句
    $select = mysqli_query($link,$sql);

    #处理结果集
    if($select && mysqli_num_rows($select)>0){
      return mysqli_fetch_all($select,MYSQLI_ASSOC);
    }
  }
  
  #处理INSERT操作
  if(substr($sql,0,6)=='INSERT'){

    #将自增设为当前最大的加一
    $pos = strpos($sql,'(');
    $table = substr($sql,12,$pos-12);
    $auto = 'ALTER TABLE '.$table.' AUTO_INCREMENT=0';
    mysqli_query($link,$auto);
    
    #发送INSERT语句
    $insert = mysqli_query($link,$sql);

    #处理结果集
    if($insert && mysqli_affected_rows($link)>0){
      return mysqli_insert_id($link);
    }
  }

  #处理UPDATE操作
  if(substr($sql,0,6)=='UPDATE'){

    #发送UPDATE语句
    $update = mysqli_query($link,$sql);

    #处理结果集
    if($update && mysqli_affected_rows($link)>0){
      return mysqli_affected_rows($link);
    }
  }

  #处理DELETE操作
  if(substr($sql,0,6)=='DELETE'){

    #发送DELETE语句
    $delete = mysqli_query($link,$sql);

    #处理结果集
    if($delete = mysqli_affected_rows($link)>0){
      return mysqli_affected_rows($link);
    }
  }

  #关闭数据库连接
  if(!empty($close)){
    mysqli_close($link);
  }
}