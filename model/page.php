<?php
/*
    分页函数
    -----------------------------------------------
    @auther Tommy Dai   Email:236860783@qq.com
    -----------------------------------------------
    @parem  $rows  int  总行数
    -----------------------------------------------
    @parem  $num   int  每页显示行数
    -----------------------------------------------
    @return $page  array
    -----------------------------------------------
*/

function page($rows, $num){

  #url重构
  $request_url = parse_url($_SERVER['REQUEST_URI']);
  $path = $request_url['path'];
  parse_str($_SERVER['QUERY_STRING'],$arr);
  unset($arr['page']);
  $query = empty($arr) ? null : '&'.http_build_query($arr);
  
  #页码生成
  $first = 1;
  $end = ceil($rows / $num);
  $curr = empty($_GET['page']) ? 1 : abs(round($_GET['page']));
  $curr = $curr>$end ? $end : ($curr==0 ? 1 : $curr);
  $p = '<a class="first" href="'.$path.'?page=1'.$query.'">首页</a>';
  for($i=$curr-4;$i<=$curr+4;$i++){
    if($i>0 && $i<=$end){
      if($i==$curr){
        $p .= '<span>'.$i.'</span>';
      }else{
        $p .= '<a class="num" href="'.$path.'?page='.$i.$query.'">'.$i.'</a>';
      }
    }
  }
  $p .= '<a class="end" href="'.$path.'?page='.$end.$query.'">尾页</a>';
  $limit = abs(($curr-1)*$num);
  $limit = 'limit'.' '.$limit.','.$num;
  
  #page信息和limit信息写入$page数组并返回
  $page['page'] = $p;
  $page['limit'] = $limit;
  $page['curr'] = $curr;
  $page['rows'] = $rows;
  return $page;
}