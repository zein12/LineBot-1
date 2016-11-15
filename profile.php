<?php 
    $channelID = "1488211839"; 
    $channelSecret = "3eec2a0e5a022b191d8f90330fbcaa20"; 
    $channelMID = "uf714a5b008cca057a4cb8cf7c0cb2e6c";
    $url  =  "https://trialbot-api.line.me/v1/profiles?mids={$channelMID}" ; 
    $headers = array(
      "Content-Type: application/json; charser=UTF-8",
      "Access-Control-Allow-Origin: *",
      "X-Line-ChannelID: " . $channelID,
      "X-Line-ChannelSecret: " . $channelSecret,
      "X-Line-Trusted-User-With-ACL: " . $channelMID
    );
    
    $ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$result = curl_exec($ch);
		curl_close($ch);

		echo $result . "\r\n";
