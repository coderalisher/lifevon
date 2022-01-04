<?php
ob_start();
define('API_KEY',"5027081878:AAEmlv62tzkPVTdQfhhrHWWDMjV_RI0AUHo");

$admin = '2067700229';
$mybot = "Sanawshi_UBot";

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$mesid = $message->message_id;
$text = $message->text; 
$data = $update->callback_query->data;
$id = $update->callback_query->id;
$chatid = $update->callback_query->message->chat->id;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id2 = $update->callback_query->message->message_id;
$type = $update->message->chat->type;
$namegroup = $update->message->chat->title;
$ufname = $update->message->from->first_name;
$uname = $update->message->from->last_name;
$ulogin = $update->message->from->username;
$user_id = $update->message->from->id;
$uid= $message->from->id;
$capt = $message->caption;
$query = $update->inline_query->query;
$inlineid = $update->inline_query->from->id; 
$mtext = $message->text;
$channelid = file_get_contents("azo/$chat_id/channelid.txt");
$photo = $update->message->photo;
$forward = $update->message->forward_from;
$video = $update->message->video;
$location = $update->message->location;
$sticker = $update->message->sticker;
$document = $update->message->document;
$contact = $update->message->contact;
$game = $update->message->game;
$music = $update->message->audio;
$gif = $update->message->gif;
$voice = $update->message->voice;
$forchaneel = json_decode(file_get_contents("https://api.telegram.org/bot$API_KEY/getChatMember?chat_id=@$channelid&user_id=".$uid)); 
$tch = $forchaneel->result->status;
$type = $update->message->chat->type;
$get = file_get_contents("https://api.telegram.org/bot$API_KEY/getChatMember?chat_id=$chat_id&user_id=".$uid);
$info = json_decode($get, true);
mkdir("data");
mkdir("azo");
mkdir("azo/$chat_id");
$odam=file_get_contents("azo/$chat_id/$uid.txt");
$ok=file_get_contents("$chat_id/ok.txt");
$guruhlar=file_get_contents("data/Guruh.lar");
$userlar=file_get_contents("data/User.lar");
$from_id = $message->from->id;
if(file_get_contents("azo/$chat_id/$uid.txt")){
}else{    file_put_contents("bot/$chatid.referal","0");
}

if(isset($message)){
  if($type == "group" or $type == "supergroup"){
    if(stripos($guruhlar,"$chat_id")!==false){
    }else{
    file_put_contents("data/Guruh.lar","$guruhlar\n$chat_id");
    }
  }else{
   $userlar = file_get_contents("data/User.lar");
   if(stripos($userlar,"$chat_id")!==false){
    }else{
    file_put_contents("data/User.lar","$userlar\n$chat_id");
   }}}

$us = bot('getChatMembersCount',[
'chat_id'=>$chat_id,
]);
$count = $us->result;

$sana = date('d.m.y', strtotime('5 hour'));
$soat = date('H:i', strtotime('5 hour'));
$login0 = $message->chat->username;
if($login0 == null){
$logincha = "Kiritlmagan!";}else{
$logincha = "@".$login0;	
}

$so = file_get_contents("azo/$chat_id/soat.txt");

if($so==true){
bot('setChatDescription',[
'chat_id'=>$chat_id,
'description'=>"👋 Guruhimizga xush kelibsiz!\n😊Kuningiz xayrli va Barokatli o'tsin! \n📆Bugun: $sana \n⏰Soat: $soat \n🛡Guruhimiz: $logincha \n👥Guruh a'zolari: $count",
]);
}

if($text=="/start"  or $text=="/start@$mybot"){
	bot('SendMessage',[
	'chat_id' => $chat_id,
	'text' => "🎲 Assalomu Alaykum 👨🏻‍✈️Bizning bot guruxlarda ishlaydi! 👨‍💻Gruxingizga Admin qiling va 🤖Botimiz o'z ish faoliyatini boshlaydi 🧾Botimiz haqida to'liq ma'lumot uchun 🎗️/haqida tugmachasini bosing",
         'reply_markup' =>  json_encode([
                'inline_keyboard' => [
[['text' => "➕Guruhga qo'shish",'url'=>"https://telegram.me/$mybot?startgroup=new"]],
    ]
])
        ]);
}

if((stripos($text,"/start")!==false)){
	if($type == "supergroup" or $type == "group"){
	bot('SendMessage',[
	'chat_id' => $chat_id,
	'text' => "🎲 Assalomu Alaykum 👨🏻‍✈️Bizning bot guruxingizga qo'shildi! 👨‍💻Gruxingizga Admin qiling va 🤖Botimiz o'z ish faoliyatini to'liq boshlaydi",
        ]);
}
}

?>