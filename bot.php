<?php
$access_token = 'ZZBpFxnTKtJQtRFjwwuHm+fFqRPk8Vw+bvFh6HtfsaNNkpc4F3+yRUPqFMUEgyaoWpbjQcvJ9+OXQSu89T5hpc5/Gqqmivcwv7LUip9smTviGg6vwZjT+KomW0QuJ4wZsJ3hqXsoDz9iYD4UxBnidQdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
//print_r($content);
// Parse JSON
$events = json_decode($content, true);
 
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
 	foreach ($events['events'] as $key => $event) {
		
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			$id = $event['message']['id'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			if($text=='Diew'){
				$text = 'คุณเก่งมากๆๆเลย ';	
			}
			// Build message to reply back
 		}
	}
	$messages = [
				'type' => 'text',
				'text' => $text.'| msg_id->'.$id.' | UID -> '.$event['source']['userId']
			    ];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
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

			echo $result . '\r\n';
			exit();
}
//echo 'OK';
