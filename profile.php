<?php  
/*
    $channelID = "1488211839"; 
    $channelSecret = "3eec2a0e5a022b191d8f90330fbcaa20"; 
    $channelMID = "uf714a5b008cca057a4cb8cf7c0cb2e6c";      
    $url  =  "https://trialbot-api.line.me/v1/profiles?mids={$channelMID}" ; 
    $headers = array(
      "Content-Type: application/json; charser=UTF-8",  
      "X-Line-ChannelID: " . $channelID,
      "X-Line-ChannelSecret: " . $channelSecret,
      "X-Line-Trusted-User-With-ACL: " . $channelMID
    ); 
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

		echo $result . "\r\n";
  */
/*  
$access_token = '/uRUSV5cXcYdnAjK7n16+BE9EavYwZay0E3zYt340wH+E3J95IwzSPT++IDf6tHTxHlDW1Az0IVwi7pqjfIAza+J0qRA+7+1nzAIZN1JEx1Ly8KSNXXY1pKm8VFpWLbdNy3iwH6cH4fchucMF16kNAdB04t89/1O/w1cDnyilFU=';
  
 $url = 'https://api.line.me/v1/profile';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
  */


/*
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
*/
/*
$access_token = '/uRUSV5cXcYdnAjK7n16+BE9EavYwZay0E3zYt340wH+E3J95IwzSPT++IDf6tHTxHlDW1Az0IVwi7pqjfIAza+J0qRA+7+1nzAIZN1JEx1Ly8KSNXXY1pKm8VFpWLbdNy3iwH6cH4fchucMF16kNAdB04t89/1O/w1cDnyilFU=';
 $user = "Uc23982bf348aa387c2b73bcb2051a709";
$url = 'https://api.line.me/v1/profile/{'.$user.'}';
      $headers = array('Authorization: Bearer ' . $access_token);        
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      $result = curl_exec($ch);
      curl_close($ch);
      $ch_result = json_decode($result, true);
      var_dump($ch_result);
      */
      
    $channelID = "1497601714"; 
    $channelSecret = "a6b4b1a80d9f25eb0a719fc92cef7d86"; 
    $channelMID = "u813b14dcc0c637534ead87aab65534da";      
    $url  =  "https://api.line.me/v2/bot/profile/".$channelMID; 
    $access_token = '3/cEBpOR0mjAMUtnHKrSrx3N6FnMVNPYfXBIwMO6HNGaljxuxTxZz2fGrmZYFwqfV3dvAWMa7FEGrmOONfbZ7or1wxYgpjbtFMS0Mkk+RftjvYSrUpThxAHGiivf2M662z2zM5P8BSKby0dJiBG3GQdB04t89/1O/w1cDnyilFU=';
    echo $url;
      
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      $result = curl_exec($ch);
      curl_close($ch);
      $ch_result = json_decode($result, true);
      var_dump($ch_result);
