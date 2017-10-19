<?php
$access_token = 'ftnj1K6SBDQnLoJbTHwFaKoMooMOS7Ax7zCRIV4Rfm6I3z6Qds';
$url = '210.1.58.130/~demomlm/app/v1.0/index.php/member/dashboard/';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "mem_id=0000001");
$result = curl_exec($ch);
curl_close($ch);

echo $result;
$jsonde = json_decode($result, true, 512, JSON_UNESCAPED_UNICODE);
$text = 'รหัสสมาชิก	 = '.$jsonde[0]['data_profile']['mem_id'].'
				';
				$text .= 'ประเภทสมาชิก		 = '.$jsonde[0]['data_profile']['type'].'
				';
				$text .= 'วันที่สมัคร		 = '.$jsonde[0]['data_profile']['mdate'].'
				';
				$text .= 'คะแนนส่วนตัว		 = '.$jsonde[0]['data_pv']['per_score']['per_pv'].'
				';
				$text .= 'รายละเอียด	 = '.$jsonde[0]['data_pv']['per_score']['link_detail'].'0000001'.'
				';
echo $text;				

?>