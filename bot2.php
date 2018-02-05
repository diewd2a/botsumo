<?php
$access_token = 'vS8RaOnPX1Dzs1q4LCqtlTP6eTe8QPZr0W5h+8aSxzkBVe7ZAelz+YKVhx3KIZ3sOjrqO7f0ZQAZBmX21E6v5455agkTP14eUu6Wud4vABIL05lEACYc5r3m6VaSZ68N6VzciH6zDDAwOp1nLxQ4zQdB04t89/1O/w1cDnyilFU=';
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
			if($text=='DOOF Story'){
				$text = 'Thank you!';	
			}
			else if($codem[0]=='User'){
				$text = file_get_contents('https://omcmlm.herokuapp.com/mlm.php?mem_id='.$codem[1]);
 				//$text = 'รหัสสมาชิก	 = '.$jsonde[0]['data_profile']['mem_id'];
 				
			}
			 
			else{
				$text = $text;	
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
	if($text=='Promotion'){
		$messages = [
				'type' => 'image',
				"originalContentUrl" => 'https://image.makewebeasy.com/makeweb/0/3FO8EY8YM/DefaultData/promotion.png',
				"previewImageUrl"  => 'https://image.makewebeasy.com/makeweb/r_400x400/3FO8EY8YM/DefaultData/promotion.png'
				];
	
	}
	if($text=='CommissionA'){
		$messages = [
				'type' => 'image',
				"originalContentUrl" => 'https://image.makewebeasy.com/makeweb/0/3FO8EY8YM/DefaultData/COMA_1.png',
				"previewImageUrl"  => 'https://image.makewebeasy.com/makeweb/r_400x400/3FO8EY8YM/DefaultData/COMA_1.png'
				];
	
	}
	if($text=='CommissionB'){
		$messages = [
				'type' => 'image',
				"originalContentUrl" => 'https://image.makewebeasy.com/makeweb/0/3FO8EY8YM/DefaultData/COMB_1.png',
				"previewImageUrl"  => 'https://image.makewebeasy.com/makeweb/0/3FO8EY8YM/DefaultData/COMB_1.png'
				];
	
	}
	if($text=='Promotionall'){
		$messages = [
				"type"=> "template",
			    "altText"=> "This is a buttons template",
			   "template"=> array(
			   		"type" => "buttons",
				  "thumbnailImageUrl"=> "https://image.makewebeasy.com/makeweb/0/3FO8EY8YM/DefaultData/COMB_1.png",
				  "imageAspectRatio" => "rectangle",
				  "imageSize" => "cover",
				  "imageBackgroundColor" => "#FFFFFF",
				  "title" => "Menu",
				  "text" => "Please select",
				  "actions" => array(
					  array(
						"type" => "postback",
						"label" => "Buy",
						"data" => "http://210.1.58.130/~demomlm/action=buy&itemid=123"
					  ),
					  array(
						"type" => "postback",
						"label" => "Add to cart",
						"data" => "http://210.1.58.130/~demomlm/action=add&itemid=123"
					  ),
					 array(
						"type" => "uri",
						"label" => "View detail",
						"uri" => "http://210.1.58.130/~demomlm"
					  )
			   	 	)
				 ),
				 
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
