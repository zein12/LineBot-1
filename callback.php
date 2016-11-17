<?php 
$access_token = '/uRUSV5cXcYdnAjK7n16+BE9EavYwZay0E3zYt340wH+E3J95IwzSPT++IDf6tHTxHlDW1Az0IVwi7pqjfIAza+J0qRA+7+1nzAIZN1JEx1Ly8KSNXXY1pKm8VFpWLbdNy3iwH6cH4fchucMF16kNAdB04t89/1O/w1cDnyilFU=';  
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
      
      
      // action postback
      } else if($event['type'] == 'postback') {
      }
      
      if($is_reply) {
      
      }
  }
}

funtion reply_message(){
}