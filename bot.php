<?php


$access_token = '/uRUSV5cXcYdnAjK7n16+BE9EavYwZay0E3zYt340wH+E3J95IwzSPT++IDf6tHTxHlDW1Az0IVwi7pqjfIAza+J0qRA+7+1nzAIZN1JEx1Ly8KSNXXY1pKm8VFpWLbdNy3iwH6cH4fchucMF16kNAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);  
// Validate parsed JSON data
if (!is_null($events['events'])) {
  
	// Loop through each event
	foreach ($events['events'] as $event) {
      $replyToken = $event['replyToken'];  
		// Reply only when message sent is in 'text' format
     
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
         // msg group
         /*
          {"events":[{"type":"message","replyToken":"0c1689469711418eb176b01fab6b19ed","source":{"roomId":"R7d08cea0c50156edd625aadaf9ee6bd1","type":"room"},"timestamp":1479382541473,"message":{"type":"text","id":"5218659413438","text":"\u0e21\u0e35\u0e44\u0e23"}}]}
         
         1 to 1
         
          {"events":[{"type":"message","replyToken":"0f01ff01f0354e6ea2c4c3624dd504f2","source":{"userId":"Uc23982bf348aa387c2b73bcb2051a709","type":"user"},"timestamp":1479382624545,"message":{"type":"text","id":"5218666454883","text":"w"}}]}
         
         */
			$text = $event['message']['text'];
      
      $messages = [        
        'type' => 'text',
				'text' => $text ." ".json_encode($events)       
			]; 
      /*
       $data_view = [
				'replyToken' => $replyToken,
				'messages' => [$messages_view],
			];
      */      
       /*       
       $actions_view = array(
        		'type' => 'uri' ,
            'label' =>'View detail',
            'uri'=> 'http://s1.tsuki-board.net/pics/figure/big/69686.jpg?t=1340402295'
        	);
     
       $actions_view = array(
        		'type' => 'postback' ,
            'label' =>'Buy',
            'data'=> 'action=buy&itemid=123'
        	);
       $template_view = [
        'type' => 'buttons',
        'thumbnailImageUrl' => 'https://innova-linebot.herokuapp.com/69686.jpg',
        'title' => 'Description',
        'text' =>  'cartoon one piece',
        'actions' => [$actions_view]
        ];
       $messages = [        
        'type' => 'template',
				'altText' => 'this is an template',
        'template' => $template_view
        ];
        
            
			// Build message to reply back
			$messages = [        
        'type' => 'text',
				'text' => $text." ".json_encode($data_view)       
			]; 
        
      */
       
		} else if ($event['type'] == 'message' && $event['message']['type'] == 'sticker') {  
         // Build message to reply back
  			$messages = [
  				'type' => 'sticker',
  				'packageId' => "3",
          'stickerId' => "183"            
  			];  
  	} else if ($event['type'] == 'postback') { 	 
    /* {"events":[
      {"type":"postback",
      "replyToken":"2b34541c919a46179f4f81e3b9ea6588",
      "source":{"userId":"Uc23982bf348aa387c2b73bcb2051a709","type":"user"},
      "timestamp":1479374241667,
      "postback":{"data":"action=buy&itemid=123"}}]} 
      
      // add friend         
      {"events":[
      {"type":"follow",
      "replyToken":"2b34541c919a46179f4f81e3b9ea6588",
      "source":{"userId":"Uc23982bf348aa387c2b73bcb2051a709","type":"user"},
      "timestamp":1479374241667}]}
      */
      $messages = [        
            'type' => 'text',
    				'text' => $event['postback']['data']    
    			]; 
    } else {        
        $messages = [        
            'type' => 'text',
    				'text' => json_encode($events)    
    			];
    }
    
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
        replyMessage($data, $access_token);
      
	}
}

function replyMessage($data, $access_token) {
      $url = 'https://api.line.me/v2/bot/message/reply';
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

