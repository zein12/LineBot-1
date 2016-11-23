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
      $messages = [        
            'type' => 'text',
    				'text' => json_encode($events)
    			];
          
          replyMessage($replyToken, $messages);      
      
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
