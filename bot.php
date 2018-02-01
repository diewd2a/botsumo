<?php
include('testin.php');
$access_token = 'onZk0lMu38UjCMFxwuNWG68FUhMol4e0/lFcFNuMHxNF5V0bzxwh+kBDRQ7KS8w3WqZwUileaIi8jOzD/zq2mBHgLCI/KrXAdejcb4ssr+0emsS/uqn9b1qxepRfsLEcdWDgefH/E/3uU/ryHMfN6gdB04t89/1O/w1cDnyilFU=';
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
			$codem = explode(' ',$text);
			if($text=='OMC'){
				$text = 'You WIN!';	
			}
			else if($codem[0]=='User'){
				$text = file_get_contents('https://omcmlm.herokuapp.com/mlm.php?mem_id='.$codem[1]);
 				//$text = 'รหัสสมาชิก	 = '.$jsonde[0]['data_profile']['mem_id'];
 				
			}
			if($text=='Dashboard'){
				$text = 'Dashboard';	
			}
			else{
				$text = 'No Msgs. ';	
			}
			
			
			// Build message to reply back
 		}
	}
	//'text' => $text.'| msg_id->'.$id.' | UID -> '.$event['source']['userId']
	$messages = [
				'type' => 'text',
				'text' => $text
	];
	
	if($text=='Dashboard'){
		$messages = [
				'type' => 'image',
				"originalContentUrl" => 'https://image.makewebeasy.com/makeweb/0/3FO8EY8YM/DefaultData/Deashboard_1.png',
				"previewImageUrl"  => 'https://image.makewebeasy.com/makeweb/r_400x400/3FO8EY8YM/DefaultData/Deashboard_1.png'
				];
	
	}
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
?>
