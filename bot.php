<?php


$access_token = '/uRUSV5cXcYdnAjK7n16+BE9EavYwZay0E3zYt340wH+E3J95IwzSPT++IDf6tHTxHlDW1Az0IVwi7pqjfIAza+J0qRA+7+1nzAIZN1JEx1Ly8KSNXXY1pKm8VFpWLbdNy3iwH6cH4fchucMF16kNAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);  
// Validate parsed JSON data

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
       $actions_view = array(
        		'type' => 'uri' ,
            'label' =>'View detail',
            'uri'=> 'http://s1.tsuki-board.net/pics/figure/big/69686.jpg?t=1340402295'
        	);
       */
       $actions_view = array(
        		'type' => 'postback' ,
            'label' =>'Buy',
            'data'=> 'action=buy&itemid=123'
        	);
       $template_view = [
        'type' => 'buttons',
        'thumbnailImageUrl' => 'https://innova-linebot.herokuapp.com/69686.jpg',
        'title' => 'Menu',
         'text' =>  'Please select',
        'actions' => [$actions_view]
        ];
       $messages = [        
        'type' => 'template',
				'altText' => 'this is an template',
        'template' => $template_view
        ];
        /*
     
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
  		  
    }else{
        	$messages = [        
            'type' => 'text',
    				'text' => $text." ".json_encode($events)       
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
