<?php
if(isset($_REQUEST['can_fcm'])){
$fcm = $_REQUEST['can_fcm'];


$ch = curl_init("https://fcm.googleapis.com/fcm/send");
//$fcm = 'cWmQhuH9vsQ:APA91bGTxMabONk8fygPvGGnYPnbxV-hVOOlbU7zksrjvudo1A8cD24ByzpOYYziaADDQ5jmKoDA-gDPCwR_vD2hJ-ZiiqyfwTK7q5sS96E4UTrqcNveonSvJfZW0vAHg_z4FuKzGEQn';
$header=array('Content-Type: application/json',
"Authorization: key=AAAAr5dsauA:APA91bG3pQHCCk7qKySm0ZPdbuGq3jfprQyd4S63a4gCzm05-FpQn5mOvkDr_32anCnpdV4FJoiteGf4Wv_0CKdOttzxGPYheGWapm6MJapNB_ELQAS_-54G6pOclZ5iH3C84BBBij_u");
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"notification\": {    \"title\": \"New Order\",    \"text\": \"New Customer Order\", \"icon\": \"ic.jpg\" ,
 \"sound\": \"helplessly.mp3\" },    \"to\" : \"$fcm\"}");

curl_exec($ch);
curl_close($ch);
}
?>