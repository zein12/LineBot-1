<?php  
     
$access_token = '3/cEBpOR0mjAMUtnHKrSrx3N6FnMVNPYfXBIwMO6HNGaljxuxTxZz2fGrmZYFwqfV3dvAWMa7FEGrmOONfbZ7or1wxYgpjbtFMS0Mkk+RftjvYSrUpThxAHGiivf2M662z2zM5P8BSKby0dJiBG3GQdB04t89/1O/w1cDnyilFU='; 
$url = 'https://api.line.me/v2/bot/message/push';   
      
$json = file_get_contents("https://dice.in.th/LineBot/friends_list.json");
$obj = json_decode($json, true);
$arr_data = array(); 
//$messages = array('type' => 'text',	'text' => "Hi.." );
$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
$messages = [
				'type' => 'text',
				'text' => "Hi.."
			];
foreach($obj as $rs) {   
    //$data = array('to' => $rs["userId"], 'messages' => $messages);
    //array_push($arr_data, $data); 
    $data = [
    	'to' => $rs["userId"],
    	'messages' => [$messages]
    ];
    $post = json_encode($data);
//var_dump($post);

 


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
//var_dump($arr_data);
 //var_dump(json_encode($arr_data));
//var_dump($jsondata);
 /* 
$messages = [
				'type' => 'text',
				'text' => "Hi.."
			];
     
$data = [
	'to' => $rs["userId"],
	'messages' => [$messages]
];

//var_dump($data);
$post = json_encode($arr_data);
//var_dump($post);

 
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
*/
 /*
    $channelID = "1488211839"; 
    $channelSecret = "3eec2a0e5a022b191d8f90330fbcaa20"; 
    $channelMID = "uf714a5b008cca057a4cb8cf7c0cb2e6c";
    $ret = array();
    $sendheaders = array(
                'Content-Type: application/json; charset=UTF-8',
                'X-Line-ChannelID: '.$channelID,
                'X-Line-ChannelSecret: '.$channelSecret,
                'X-Line-Trusted-User-With-ACL: '.$channelMID
             );

  
    $resContent = array(
      "contentType"=>1,
      "toType"=>1,
      "text"=>"Hi.."
    );
    $resp = array(
                'to' => array("Uc23982bf348aa387c2b73bcb2051a709","U9064a2310b6a52cdbb0682912ba6179c"),
                'toChannel' => 1383378250, # Fixed value
                'eventType' => '138311608800106203', # Fixed value
                'content' => $resContent,
    );
    var_dump(json_encode($resp));
  $url = "https://trialbot-api.line.me/v1/events";  
  
  $ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($resp));
curl_setopt($ch, CURLOPT_HTTPHEADER, $sendheaders);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
//$ch_result = json_decode($result, true);
echo $result;
*/

 
