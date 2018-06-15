<?php
$qq = $_POST['val'];
$appkey='f6f87442f81b991f4484bedf7921a6ed';
$params = array(
       "key" => $appkey,//您申请的appKey
       "qq" => $qq,//需要测试的QQ号码
 );
 $url = 'http://japi.juhe.cn/qqevaluate/qq';
 $paramstring = http_build_query($params);
  echo $url.'?'.$paramstring;
?>
