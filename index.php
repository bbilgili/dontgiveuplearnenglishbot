<?php
$path = "https://api.telegram.org/bot{yourToken}";

$update = json_decode(file_get_contents("php://input"), TRUE);

$chatId = $update["message"]["chat"]["id"];
$word = strtolower($update["message"]["text"]);
$response = "";

$wordmeanapi = json_decode(file_get_contents("https://api.dictionaryapi.dev/api/v2/entries/en/".$word), TRUE);

if(isset($wordmeanapi) && isset($wordmeanapi[0]) && isset($wordmeanapi[0]["meanings"])) {
	$response = $wordmeanapi[0]["meanings"][0]["definitions"][0]["definition"];
}
	
file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$response);


?>