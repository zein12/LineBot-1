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
        
          replyMessage($replyToken, $messages);
      // action postback
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


