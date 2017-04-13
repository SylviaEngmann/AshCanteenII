<?php
$ch = curl_init("https://fcm.googleapis.com/fcm/send");
$header=array('Content-Type: application/json',
"Authorization: key=AAAAr5dsauA:APA91bG3pQHCCk7qKySm0ZPdbuGq3jfprQyd4S63a4gCzm05-FpQn5mOvkDr_32anCnpdV4FJoiteGf4Wv_0CKdOttzxGPYheGWapm6MJapNB_ELQAS_-54G6pOclZ5iH3C84BBBij_u");
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"notification\": {    \"title\": \"New Order\",    \"text\": \"New Customer Order\", \"icon\": \"ic.jpg\" ,
 \"sound\": \"helplessly.mp3\" },    \"to\" : \"cEJhp6GDP50:APA91bH-5IA_aR213sHxB0kr9pkbg_lM9z75VTt9RZ_RCUQjOJwzqhVGEpU2ciuoRxXfvriDztIv9TllIzWB22K4QuoVWa8-_W0U_x7xXzzT_DTcxUXww1Yo80iXfc4GifL1Zx-8TFTC\"}");

curl_exec($ch);
curl_close($ch);
?>