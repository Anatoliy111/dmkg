<?php
$apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b';
//'token' => '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b';

//$myCurl = curl_init();
//curl_setopt_array($myCurl, array(
//    CURLOPT_URL => 'http://dmkg/viberbot/myBot.php',
//    CURLOPT_RETURNTRANSFER => true,
//    CURLOPT_POST => true,
//    CURLOPT_POSTFIELDS => http_build_query(array('token' => $apiKey))
//));
//$response = curl_exec($myCurl);
//curl_close($myCurl);
//
//echo "Ответ на Ваш запрос: ".$response;

$url = 'http://dmkg/viberbot/myBot.php';
$params = array(
    'event'=> "message",
    'timestamp'=> 1457764197627,
    'message_token'=> 4912661846655238145,
    'sender' => array(
    'id'=>'01234567890A=',
      'name'=>'John McClane',
      'avatar'=>'http://avatar.example.com',
      'country'=>'UK',
      'language'=>'en',
      'api_version'=>1
),
   'message' => array(
    'type'=>'text',
      'text'=>'a message to the service',
      'media'=>'http://example.com',
      'location' => array(
        'lat'=>50.76891,
         'lon'=>6.11499
),
      'tracking_data'=>'tracking data'
)




);
$result = file_get_contents($url, false, stream_context_create(array(
    'http' => array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query($params)
    )
)));


echo $result;