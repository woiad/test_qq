<?php
  header('Content-type:text/html;charset=utf-8');
  $appkey ="f6f87442f81b991f4484bedf7921a6ed";
  $qq = $_POST['val'];
 $url = "http://japi.juhe.cn/qqevaluate/qq";
 $params = array(
       "key" => $appkey,//您申请的appKey
       "qq" => $qq,//需要测试的QQ号码
 );
 $paramstring = http_build_query($params);
 $content = juhecurl($url,$paramstring);
 $result = json_decode($content,true);
 if($result){
     if($result['error_code']=='0'){
         print_r(json_encode($result));
     }else{
         echo $result['error_code'].":".$result['reason'];
     }
 }else{
     echo "请求失败";
     }
  function juhecurl($url,$params=false,$ispost=0){
      $httpInfo = array();
      $ch = curl_init();

      curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
      curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
      curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
      curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      if( $ispost )
      {
          curl_setopt( $ch , CURLOPT_POST , true );
          curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
          curl_setopt( $ch , CURLOPT_URL , $url );
      }
      else
      {
          if($params){
              curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
          }else{
              curl_setopt( $ch , CURLOPT_URL , $url);
          }
      }
      $response = curl_exec( $ch );
      if ($response === FALSE) {
          //echo "cURL Error: " . curl_error($ch);
          return false;
      }
      $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
      $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
      curl_close( $ch );
      return $response;
  };
?>
