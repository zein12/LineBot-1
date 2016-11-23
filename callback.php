<?php 
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true); 
// Validate parsed JSON data
if (!is_null($events['events'])) {
  //$url = 'https://api.line.me/v2/bot/message/reply';
	// Loop through each event
	
     
     $messages = [
				'type' => 'text',
				'text' => "Hi..".json_encode($events) 
			];
  
    //$data = array('to' => $rs["userId"], 'messages' => $messages);
    //array_push($arr_data, $data); 
    $data = [
    	'to' => "Uc23982bf348aa387c2b73bcb2051a709",
    	'messages' => [$messages]
    ];
    $post = json_encode($data);
     
     
      
     
                      
      $access_token = '/uRUSV5cXcYdnAjK7n16+BE9EavYwZay0E3zYt340wH+E3J95IwzSPT++IDf6tHTxHlDW1Az0IVwi7pqjfIAza+J0qRA+7+1nzAIZN1JEx1Ly8KSNXXY1pKm8VFpWLbdNy3iwH6cH4fchucMF16kNAdB04t89/1O/w1cDnyilFU='; 
      $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
      $url = 'https://api.line.me/v2/bot/message/push'; 
      
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
  
  




