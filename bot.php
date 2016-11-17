<?php
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

$access_token = '/uRUSV5cXcYdnAjK7n16+BE9EavYwZay0E3zYt340wH+E3J95IwzSPT++IDf6tHTxHlDW1Az0IVwi7pqjfIAza+J0qRA+7+1nzAIZN1JEx1Ly8KSNXXY1pKm8VFpWLbdNy3iwH6cH4fchucMF16kNAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);  
// Validate parsed JSON data
if (!is_null($events['events'])) {
  $url = 'https://api.line.me/v2/bot/message/reply';
	// Loop through each event
	foreach ($events['events'] as $event) {
      $replyToken = $event['replyToken'];
		// Reply only when message sent is in 'text' format
   
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
      
			$text = $event['message']['text'];
      /*
      $messages_view = [        
        'type' => 'text',
				'text' => $text       
			]; 
       $data_view = [
				'replyToken' => $replyToken,
				'messages' => [$messages_view],
			];
      */
      
        /*   
      $messages_view = [        
        'type' => 'template',
				'altText' => 'this is an template',
        'template' => {
            'type' => 'buttons',
    				'thumbnailImageUrl' => 'https://innova-linebot.herokuapp.com/69686.jpg',
            'title' => 'title',
            'text' =>  'test',
            'actions' => [{
                 'type' => 'uri',
                 'label' =>'View detail',
                 'uri'=> 'http://s1.tsuki-board.net/pics/figure/big/69686.jpg?t=1340402295' 
              }]
      }];
      
       */
       
       $actions_view = array(
        		'type' => 'uri' ,
            'label' =>'View detail',
            'uri'=> 'http://s1.tsuki-board.net/pics/figure/big/69686.jpg?t=1340402295'
        	);
       
       $template_view = [
        'type' => 'buttons',
        'thumbnailImageUrl: https://innova-linebot.herokuapp.com/69686.jpg',
        'title' => 'title',
         'text' =>  'test',
        'actions' => [$actions_view]
        ];
       $messages = [        
        'type' => 'template',
				'altText' => 'this is an template',
        'template' => $template_view
        ];
        /*
      $data_view = [
				'replyToken' => $replyToken,
				'messages' => [$messages_view],
			];
			// Build message to reply back
			$messages = [        
        'type' => 'text',
				'text' => $text." ".json_encode($data_view)       
			]; 
        
      */
        /*
      $actions =  [
         'type' => 'uri',
         'label' =>'View detail',
         'uri': 'http://s1.tsuki-board.net/pics/figure/big/69686.jpg?t=1340402295' 
      ];
      
      $template = [
            'type' => 'buttons',
    				'thumbnailImageUrl' => 'https://innova-linebot.herokuapp.com/69686.jpg',
            'title' => '',
            'text' =>  'test'  ,
            'actions' => [$actions]
      ];
      
      $messages = [        
        'type' => 'template',
				'altText' => 'this is an template',
        'template' => [$template],         
			];        	 	
			 */
       
		} else if ($event['type'] == 'message' && $event['message']['type'] == 'sticker') {  
         // Build message to reply back
  			$messages = [
  				'type' => 'sticker',
  				'packageId' => "3",
          'stickerId' => "183"            
  			];  
  		  
    } 
    /*else if ($event['type'] == 'message' && $event['message']['type'] == 'postback') {
        $messages = [
  				'type' => 'postback',
          'replyToken' => $replyToken,
  				'postback.data' => "33333333".json_encode($events)            
  			]; 
    } 
    */    
   // Make a POST Request to Messaging API to reply to sender   
    if (!is_null($messages)) {
      $data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			
    }else{
        $messages = [
  				'type' => 'sticker',
  				'packageId' => "1",
          'stickerId' => "5"            
  			];  
        $data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
    }
    
       /*
       $post = {
      "replyToken":$replyToken,
      "messages":[{
          "type": "template",
          "altText": "this is a buttons template",
          "template": {
              "type": "buttons",
              "thumbnailImageUrl": "https://innova-linebot.herokuapp.com/69686.jpg",
              "title": "Menu",
              "text": "Please select",
              "actions": [
                  {
                    "type": "postback",
                    "label": "Buy",
                    "data": "action=buy&itemid=123"
                  },
                  {
                    "type": "postback",
                    "label": "Add to cart",
                    "data": "action=add&itemid=123"
                  },
                  {
                    "type": "uri",
                    "label": "View detail",
                    "uri": "http://s1.tsuki-board.net/pics/figure/big/69686.jpg?t=1340402295"
                  }
              ]
          }
        }]
        };
        */
        
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

			echo $result . "\r\n";
	}
}