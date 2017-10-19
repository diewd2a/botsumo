<?php
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
 				$access_token = 'ftnj1K6SBDQnLoJbTHwFaKoMooMOS7Ax7zCRIV4Rfm6I3z6Qds';
				$url = '210.1.58.130/~demomlm/app/v1.0/index.php/member/dashboard/';
				
				$headers = array('Authorization: Bearer ' . $access_token);
				
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,
							"mem_id=".$codem[1]);
				$text = curl_exec($ch);
				curl_close($ch);
			}
			else{
				$text = '
[{"data_profile":{"mem_id":"0000001 ( Demo)","position":"DI","honor":"ST","type":"Center","mdate":"2017-07-27","sp_name":"","upa_name":"","status":"\u0e04\u0e49\u0e32\u0e07\u0e2a\u0e48\u0e07\u0e40\u0e2d\u0e01\u0e2a\u0e32\u0e23 ()"},"data_pv":{"per_score":{"per_pv":"157,010","link_detail":"http:\/\/210.1.58.130\/~demomlm\/member\/index.php?sessiontab=4&sub=38&cmc="},"Balance\/Month":"246,740 \/ October","Maintain balance1 (October)":"<font color=#0000FF><b>Active <\/b><b>(10,000)<\/b><\/font>","Maintain balance2 (November)":"<font color=#0000FF><b>Active <\/b><b>(10,000)<\/b><\/font>","PV Left old":"1,166,150","PV Right old":"0","PV Left new":{"pv":"7,630","link_detail":"http:\/\/210.1.58.130\/~demomlm\/member\/index.php?sessiontab=5&sub=116&lr=1&cmc="},"PV Right new":{"pv":"30","link_detail":"http:\/\/210.1.58.130\/~demomlm\/member\/index.php?sessiontab=5&sub=116&lr=2&cmc="},"PV Left sum":"1,173,780","PV Right sum":"30"}}]';	
			}
			// Build message to reply back
 		}
	}
	//'text' => $text.'| msg_id->'.$id.' | UID -> '.$event['source']['userId']
	$messages = [
				'type' => 'text',
				'text' => $text
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
