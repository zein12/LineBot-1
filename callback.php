<?php 
 
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true); 
// Validate parsed JSON data
if (!is_null($events['events'])) {
  //$url = 'https://api.line.me/v2/bot/message/reply';
	// Loop through each event
	foreach ($events['events'] as $event) {
      $replyToken = $event['replyToken']; 
       // add friend
      if($event['type'] == 'follow') {
         /*
         {"events":[
          {"type":"follow",
          "replyToken":"2b34541c919a46179f4f81e3b9ea6588",
          "source":{"userId":"Uc23982bf348aa387c2b73bcb2051a709","type":"user"},
          "timestamp":1479374241667}]}
      */       
        
          $url = 'https://dice.in.th/LineBot/manage_data.php';
          $data = [
            				'events' => $event['type'],
            				'userId' => $event['source']['userId'],
            			];
          $post = json_encode($data);
    			$headers = array('Content-Type: application/json');
    
    			$ch = curl_init($url);
    			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    			$result = curl_exec($ch);
    			curl_close($ch);
       
       // Reply only when message sent 
		  } else if($event['type'] == 'message') {
         
          switch ($event['message']['type']) {
              case "text":
                  $text = $event['message']['text'];
                  if($text == 'shop'){
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
                  }else{
                      $messages = [        
                        'type' => 'text',
                				'text' => $text    
                			]; 
                  }
                  break; 
              case "sticker":
                  $messages = [
            				'type' => 'sticker',
            				'packageId' => "3",
                    'stickerId' => "183"            
            			];
                  break;
              default:
                  $messages = [
            				'type' => 'sticker',
            				'packageId' => "1",
                    'stickerId' => "5"            
            			]; 
                  break;                      
          }           
        
          if($event['source']['type'] != "room") {
              replyMessage($replyToken, $messages);
          }
      // action postback
      } else if($event['type'] == 'postback') {
      
        /*
        {"events":[
      {"type":"postback",
      "replyToken":"2b34541c919a46179f4f81e3b9ea6588",
      "source":{"userId":"Uc23982bf348aa387c2b73bcb2051a709","type":"user"},
      "timestamp":1479374241667,
      "postback":{"data":"action=buy&itemid=123"}}]} 
      */
      
          $messages = [        
            'type' => 'text',
    				'text' => $event['postback']['data']    
    			];
          
          replyMessage($replyToken, $messages); 
          
      // join
      } else if($event['type'] == 'join') {
           /*
           {"events":[{"type":"join","replyToken":"26c5f7246f83406aa99bb5a3942462f4","source":{"roomId":"R7d08cea0c50156edd625aadaf9ee6bd1","type":"room"},"timestamp":1479378196834}]}
           */
          /*
          $url = 'https://dice.in.th/LineBot/manage_data.php';
          if($event['source']['type'] == "room") {
              $data = [
            				'events' => $event['type'],
                    'sourceType' => $event['source']['type'],
            				'roomId' => $event['source']['roomId'],
            			];
          } else {
                $data = [
            				'events' => $event['type'],
                    'sourceType' => $event['source']['type'],
            				'groupId' => $event['source']['groupId'],
            			];
          }
          
          $post = json_encode($data);
         
    			$headers = array('Content-Type: application/json');
    
    			$ch = curl_init($url);
    			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    			$result = curl_exec($ch);
    			curl_close($ch);
             */
          $messages = [        
            'type' => 'text',
    				'text' => json_encode($events) ." ".$post
    			];
          
          replyMessage($replyToken, $messages);
          
      // join
      } else if($event['type'] == 'leave') {
        $messages = [        
            'type' => 'text',
    				'text' => json_encode($events)
    			];
          
          replyMessage($replyToken, $messages);
      }       
      
  }
}

function replyMessage($replyToken, $data_messages) {
      $access_token = '/uRUSV5cXcYdnAjK7n16+BE9EavYwZay0E3zYt340wH+E3J95IwzSPT++IDf6tHTxHlDW1Az0IVwi7pqjfIAza+J0qRA+7+1nzAIZN1JEx1Ly8KSNXXY1pKm8VFpWLbdNy3iwH6cH4fchucMF16kNAdB04t89/1O/w1cDnyilFU='; 
      $url = 'https://api.line.me/v2/bot/message/reply';
      $data = [
        				'replyToken' => $replyToken,
        				'messages' => [$data_messages],
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

			echo $result . "\r\n";    
}

function LeaveRequest($leaveType, $id) {
      $access_token = '/uRUSV5cXcYdnAjK7n16+BE9EavYwZay0E3zYt340wH+E3J95IwzSPT++IDf6tHTxHlDW1Az0IVwi7pqjfIAza+J0qRA+7+1nzAIZN1JEx1Ly8KSNXXY1pKm8VFpWLbdNy3iwH6cH4fchucMF16kNAdB04t89/1O/w1cDnyilFU='; 
      if($leaveType == 'room')  $url = 'https://api.line.me/v2/bot/room/{'.$id.'}/leave';
      else  $url = 'https://api.line.me/v2/bot/group/{'.$id.'}/leave';
     
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";    
}

function manageRequest($data_post) {
       
      $url = 'https://dice.in.th/LineBot/manage_data.php';      
     
      $post = json_encode($data_post);
			$headers = array('Content-Type: application/json');

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
      return $result;
			//echo $result . "\r\n";    
}