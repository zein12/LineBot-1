<?php
$headers = getallheaders();

if(isset($headers["X-LINE-ChannelSignature"])){
  $json_string = file_get_contents('php://input');
  if(base64_decode($headers["X-LINE-ChannelSignature"]) === hash_hmac("sha256",$json_string,$LINE_SECRET,true)){
    botmain(json_decode($json_string));
  }
}

function botmain($json){
  $channelID = "1488211839"; 
  $channelSecret = "3eec2a0e5a022b191d8f90330fbcaa20"; 
  $channelMID = "uf714a5b008cca057a4cb8cf7c0cb2e6c"; 
  $results = $json->result;
  $ret = array();
  $sendheaders = array(
                'Content-Type: application/json; charset=UTF-8',
                'X-Line-ChannelID: '.$channelID,
                'X-Line-ChannelSecret: '.$channelSecret,
                'X-Line-Trusted-User-With-ACL: '.$channelMID
             );

  for($i=0;$i<count($results);++$i){
    $resContent = array(
      "contentType"=>1,
      "toType"=>1,
      "text"=>"say:".$results[$i]->content->text
    );
    $resp = array(
                'to' => array($results[$i]->content->from),
                'toChannel' => 1383378250, # Fixed value
                'eventType' => '138311608800106203', # Fixed value
                'content' => $resContent,
    );
  $url = "https://trialbot-api.line.me/v1/events";
  $curl = curl_init($url);
  $options = array(
    CURLOPT_HTTPHEADER => $sendheaders,
    CURLOPT_POST => true,//POST
    CURLOPT_POSTFIELDS => json_encode($resp), 
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true
  );
  curl_setopt_array($curl, $options);
  $result = curl_exec($curl);
  curl_close($curl);
  }
}
 