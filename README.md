1.数组转JSON

PHP json_encode() 用于对变量进行 JSON 编码，该函数如果执行成功返回 JSON 数据，否则返回 FALSE 。
![image](https://github.com/Acegem/API-JSON/blob/master/josn_encode.PNG)

2.JSON转数组

PHP json_decode() 函数用于对 JSON 格式的字符串进行解码，并转换为 PHP 变量。
当 $data= json_decode($object);  //得到的是 object 上面数据类型。
当 $data= json_decode($object, ture);  //得到的则是数组。
![image](https://github.com/Acegem/API-JSON/blob/master/josn_decode.PNG)


3.【实战】第三方接口解析（stdClass Object转array）
开发web网站，使用到第三方API接口的JSON数据，往往单纯通过json_decode方法解析获得的数值一般并非数组，
而是带有stdClass Objec的对象字符串，这时如果我们想获取相应的PHP数组时，需将对象转化为数组来获取。函数封装如下：

![file](https://github.com/Acegem/API-JSON/blob/master/ArrayAndObject.php)

'''php 
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
