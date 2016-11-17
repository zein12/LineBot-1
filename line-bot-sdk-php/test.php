<?php

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('/uRUSV5cXcYdnAjK7n16+BE9EavYwZay0E3zYt340wH+E3J95IwzSPT++IDf6tHTxHlDW1Az0IVwi7pqjfIAza+J0qRA+7+1nzAIZN1JEx1Ly8KSNXXY1pKm8VFpWLbdNy3iwH6cH4fchucMF16kNAdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '3eec2a0e5a022b191d8f90330fbcaa20']);
$response = $bot->replyText('"5f294a1679c04fada975568a00e1ba91', 'hello!');