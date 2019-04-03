<?php
//一维数组转对象：直接(object)$arr;
//多维数组转对象：循环遍历一层层使(object)$tmp_arr;必定递归实现。
//完整代码如下：
function arrayToObject($arr) {
  if(getType($arr) != 'array') {
    return;
  }
  foreach($arr as $k => $v) { //遍历数组，若多维，则转为对象。
    if(gettype($v) == 'array' || gettype($v) == 'object') {//多维数组
      $arr[$k] = (object)arrayToObject($V);
    }
  }
  return (object)$arr;
}

//一级对象转数组：直接(array)$obj;
//多级对象转数组：(array)$obj转为数组后，再循环遍历一层层使(array)$tmp_obj；必定递归实现。
//完整代码如下：
function objectToArray($obj) {
  $obj = (array)$obj; //转为一维数组
  foreach($obj as $k => $v){ //遍历一维数组，若元素值有对象则再转为数组,(array)$tmp_obj;层层如此深入
    if(gettype($v) == 'resource'){
      return;
    }
    if(gettype($v) == 'object' || gettype($v) == 'array'){ //多级对象
      $obj[$k] = (array)objectToArray($v);
    }
  }
  return $obj;
}

?>
