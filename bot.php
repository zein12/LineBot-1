<?php
$access_token = '/uRUSV5cXcYdnAjK7n16+BE9EavYwZay0E3zYt340wH+E3J95IwzSPT++IDf6tHTxHlDW1Az0IVwi7pqjfIAza+J0qRA+7+1nzAIZN1JEx1Ly8KSNXXY1pKm8VFpWLbdNy3iwH6cH4fchucMF16kNAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');

$json = json_decode($content, true);
 foreach ($json[ 'result'] as $result) {
    $content = $result[ 'content'];
    if ($result[ 'eventType'] == '138311609100106403') {
        // Join a friend or blocked
        $mid = $content['params'][0];
        if ($content[ 'opType'] == 4) {
            echo 'Add as friend' $mid;
        }
        if ($content [ 'opType'] == 8) {
            echo 'blockade' $mid;
        }
       
    }else if ($result[ 'eventType'] == '138311609000106303') {
           echo '55555555';
    }
}