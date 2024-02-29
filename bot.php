<?php
$botToken = '7122917815:AAGueLNZGrqBUO-_4MRhZrZuKvBdtMhsrEw';

function programmerBot($method, $datas =[]){
    global $botToken;
    $curl = curl_init("https://api.telegram.org/bot".$botToken."/".$method);
    curl_setopt_array($curl, [
    CURLOPT_POSTFIELDS => $datas,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_SSL_VERIFYPEER => false,
    ]);

    $response = json_decode(curl_exec($curl));
    return $response;
}

$update = json_decode(file_get_contents('php://input'));
$message =$update->message;
$text= $message->text;
$chat_id=$message->chat->id;
$webhookInfo = programmerBot('getWebhookInfo');
var_dump($webhookInfo);



if($text == "/start"){
    programmerBot('sendMessage',['chat_id'=>$chat_id, 'text'=>"Hello"]);
}
else
{
    if($text == "hi")
    {
    programmerBot('sendMessage',['chat_id'=>$chat_id, 'text'=>"Hello"]);  
    }

}


// $result= programmerBot('sendMessage',['chat_id'=>5927971184,'text'=>"Hello"]);
// echo $result->ok;
