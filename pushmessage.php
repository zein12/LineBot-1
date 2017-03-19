<?php
if(isset($_POST['userId'])){
$access_token = '3/cEBpOR0mjAMUtnHKrSrx3N6FnMVNPYfXBIwMO6HNGaljxuxTxZz2fGrmZYFwqfV3dvAWMa7FEGrmOONfbZ7or1wxYgpjbtFMS0Mkk+RftjvYSrUpThxAHGiivf2M662z2zM5P8BSKby0dJiBG3GQdB04t89/1O/w1cDnyilFU=';
 
$url = 'https://api.line.me/v2/bot/message/push';
$messages = [
				'type' => 'text',
				'text' => "Hello ".$_POST['displayName']
			];
$data = [
	'to' => $_POST['userId'],
	'messages' => [$messages],
];
$post = json_encode($data);
$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
//$ch_result = json_decode($result, true);
echo $result;
}  
/*
$url = 'https://api.line.me/v1/events';
$data = {
	'to' : ["uf714a5b008cca057a4cb8cf7c0cb2e6c"],
	'toChannel' : "1488211839",
  "eventType":"138311608800106203",
  "content":{
    "id": "325708",
    "contentType": 1,
    "from": "uff2aec188e58752ee1fb0f9507c6529a",
    "createdTime": 1462629479859,
    "to": [
      "u0a556cffd4da0dd89c94fb36e36e1cdc"
    ],
    "toType": 1,
    "contentMetadata": {
    },
    "text": "test",
    "location": null
  }
};
$post = json_encode($data);
$headers = array(
      "Content-Type: application/json; charser=UTF-8",  
      "X-LINE-ChannelToken: " . $access_token,
    ); 
    
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result . "\r\n";
*/ 

     
