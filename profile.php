<?php  
/*
    $channelID = "1488211839"; 
    $channelSecret = "3eec2a0e5a022b191d8f90330fbcaa20"; 
    $channelMID = "uf714a5b008cca057a4cb8cf7c0cb2e6c";      
    $url  =  "https://trialbot-api.line.me/v1/profiles?mids={$channelMID}" ; 
    $headers = array(
      "Content-Type: application/json; charser=UTF-8",  
      "X-Line-ChannelID: " . $channelID,
      "X-Line-ChannelSecret: " . $channelSecret,
      "X-Line-Trusted-User-With-ACL: " . $channelMID
    ); 
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

		echo $result . "\r\n";
  */
/*  
$access_token = '/uRUSV5cXcYdnAjK7n16+BE9EavYwZay0E3zYt340wH+E3J95IwzSPT++IDf6tHTxHlDW1Az0IVwi7pqjfIAza+J0qRA+7+1nzAIZN1JEx1Ly8KSNXXY1pKm8VFpWLbdNy3iwH6cH4fchucMF16kNAdB04t89/1O/w1cDnyilFU=';
  
  $url = 'https://api.line.me/v1/profile';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
  */
$actions =  [{
         'type' => 'postback',
         'label' =>"test button postback"
         'data' => "item=123"
         }
      ];
      
       /*
      $messages = [        
        'type' => 'template',
				'allText' => 'this is an template',
        'template' => {
           'type' : 'buttons',
    				'thumbnailImageUrl' : 'http://1.bp.blogspot.com/_VChD0TN44Cc/S8nYSoHXeQI/AAAAAAAAIrg/frnUGRABF2w/s400/3.1.jpg',
            'title' : 'test button',
            'text' :  'event message text',
        },
        
			];
      
      $data = [
				'replyToken' => 'replyToken',
				'messages' => [$messages],
			];
      */
      $post = $actions;
      
      echo $post;