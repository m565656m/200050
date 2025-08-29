<?php
$admin = dddoip.serv00;
$token = file_get_contents("token.txt");
$brokweb = "https://two00050-4.onrender.com";
#==================#

#==================#
define('API_KEY', $token);
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
function sendmessage($chat_id, $text){
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>$text,
 'parse_mode'=>"MarkDown"
 ]);
} 
 function sendphoto($chat_id, $photo, $caption){
 bot('sendphoto',[
 'chat_id'=>$chat_id,
 'photo'=>$photo,
 'caption'=>$caption,
 ]);
}
function sendsticker($chat_id,$sticker_id,$caption){
    bot('sendsticker',[
        'chat_id'=>$ChatId,
        'sticker'=>$sticker_id,
        'caption'=>$caption
    ]);
 } 
//-//////
$update = json_decode(file_get_contents('php://input'));
$message = $update->message; 
$chat_id = $message->chat->id;
$text = $message->text;
$chatid = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$message_id = $update->callback_query->message->message_id;

$chat_id2 = $update->callback_query->message->chat->id;
$user_id = $message->from->id;
$name = $message->from->first_name;
$username = $message->from->username;
// قراءة معرفات المستخدمين المخزنة في الملف وتحويلها إلى مصفوفة
$u = explode("\n", file_get_contents("database/ID.txt"));

// حساب عدد الأعضاء الحاليين
$c = count($u) - 1;

// التأكد من أن $update و $chat_id تم تعريفهما وأن $chat_id غير موجودة بالفعل في المصفوفة $u
$ban = file_get_contents("database/ban.txt");
$exb = explode("\n",$ban);



    // إرسال رسالة إلى الإدمن عن المستخدم الجديد
 

#===============
mkdir("database");
mkdir("database/$chat_id");
#==========لوحه تحكم========#
$id = $message->from->id;
$text = $message->text;
$chat_id = $message->chat->id;
$user = $message->from->username;
$name = $message->from->first_name;
$sajad = file_get_contents("database/rembo.txt");
$ch = file_get_contents("database/ch.txt");
$tn = file_get_contents("database/tnb.txt");

$bot = file_get_contents("database/bot.txt");

$m = explode("\n",file_get_contents("database/ID.txt"));
$m1 = count($m)-1;
if($message and !in_array($id, $m)){
file_put_contents("database/ID.txt", $id."\n",FILE_APPEND);
 }
if (isset($update) && !in_array($chat_id, $u)) {
    // حفظ معرف المستخدم الجديد إلى الملف
    file_put_contents("database/ID.txt", $chat_id . "\n", FILE_APPEND);
if($text =="/start"and $tn =="on"and $id !=$admin){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>
"
🔔 *تنبيه: مستخدم جديد انضم إلى البوت الخاص بك!*
👨‍💼¦ اسمه » ️ [$name](tg://user?id=$id)
🔱¦ معرفه »  ️[@$user](tg://user?id=$id)
💳¦ ايديه » ️ [$id](tg://user?id=$id)
📊 *عدد الأعضاء الكلي:* $c
",
'parse_mode'=>"MarkDown",
]);
}
}
if($text =='/start' and $id ==$admin){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text' => "مرحبًا! إليك أوامرك: ⚡📮\n\n
1. إدارة المشتركين والتحكم بهم.\n
2. إرسال إذاعات ورسائل موجهة.\n
3. ضبط إعدادات الاشتراك الإجباري.\n
4. تفعيل أو تعطيل التنبيهات.\n
5. إدارة حالة البوت ووضع الاشتراك.",
'reply_markup' => json_encode([
    'inline_keyboard' => [
        [['text' => "المشتركين 👥", 'callback_data' => "m1"]],
        [['text' => "إذاعة رسالة 📮", 'callback_data' => "send"], ['text' => "توجيه رسالة 🔄", 'callback_data' => "forward"]],
        [['text' => "وضع اشتراك إجباري 💢", 'callback_data' => "ach"], ['text' => "حذف اشتراك إجباري 🔱", 'callback_data' => "dch"]],
        [['text' => "تفعيل التنبيه ✔️", 'callback_data' => "ons"], ['text' => "تعطيل التنبيه ❎", 'callback_data' => "ofs"]],
        [['text' => "فتح البوت ✅", 'callback_data' => "obot"], ['text' => "إيقاف البوت ❌", 'callback_data' => "ofbot"]],
        [['text' => "وضع المدفوع 💰", 'callback_data' => "pro"], ['text' => "وضع المجاني 🆓", 'callback_data' => "frre"]],
        [['text' => "اظافه عظو مدفوع 💰", 'callback_data' => "pro123"], ['text' => "ازاله عظو مدفوع 🆓", 'callback_data' => "frre123"]],
        [['text' => "حظر عضو 🚫", 'callback_data' => "ban"], ['text' => "إلغاء حظر عضو ❌", 'callback_data' => "unban"]],
    ]
])
]);

}

if($data =='back'){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$update->callback_query->message->message_id,
'text' => "مرحبًا! إليك أوامرك: ⚡📮\n\n
1. إدارة المشتركين والتحكم بهم.\n
2. إرسال إذاعات ورسائل موجهة.\n
3. ضبط إعدادات الاشتراك الإجباري.\n
4. تفعيل أو تعطيل التنبيهات.\n
5. إدارة حالة البوت ووضع الاشتراك.",
'reply_markup' => json_encode([
    'inline_keyboard' => [
        [['text' => "المشتركين 👥", 'callback_data' => "m1"]],
        [['text' => "إذاعة رسالة 📮", 'callback_data' => "send"], ['text' => "توجيه رسالة 🔄", 'callback_data' => "forward"]],
        [['text' => "وضع اشتراك إجباري 💢", 'callback_data' => "ach"], ['text' => "حذف اشتراك إجباري 🔱", 'callback_data' => "dch"]],
        [['text' => "تفعيل التنبيه ✔️", 'callback_data' => "ons"], ['text' => "تعطيل التنبيه ❎", 'callback_data' => "ofs"]],
        [['text' => "فتح البوت ✅", 'callback_data' => "obot"], ['text' => "إيقاف البوت ❌", 'callback_data' => "ofbot"]],
        [['text' => "وضع المدفوع 💰", 'callback_data' => "pro"], ['text' => "وضع المجاني 🆓", 'callback_data' => "frre"]],
        [['text' => "اظافه عظو مدفوع 💰", 'callback_data' => "pro123"], ['text' => "ازاله عظو مدفوع 🆓", 'callback_data' => "frre123"]],
        [['text' => "حظر عضو 🚫", 'callback_data' => "ban"], ['text' => "إلغاء حظر عضو ❌", 'callback_data' => "unban"]],
    ]
])
]);

unlink("database/rembo.txt");
}
if($data =="unban"){
bot('editmessagetext',[
'chat_id'=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id,
'text'=>"حسنا عزيزي ارسل ايدي العضو لالغاء حظره🔱", 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"الغاء الامر❎",'callback_data'=>"back"]],
]
])
]);
file_put_contents("database/$token/rembo.txt","unban");
}
if($text and $sajad =="unban" and $id ==$admin){
$bn = str_replace($text,'',$ban);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تم الغاء حظر العضور بنجاح✅",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"العودة🔙",'callback_data'=>"back"]],
]
])
]);
file_put_contents("database/$token/ban.txt",$bn);
unlink("database/$token/rembo.txt");
bot('SendMessage',[
'chat_id'=>$text,
'text'=>"تم الغاء حظرك من البوت🤩",
]);
}
if($data =="ban"){
bot('editmessagetext',[
'chat_id'=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id,
'text'=>"حسنا عزيزي ارسل ايدي العضو لاحظره🤩", 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"الغاء الامر❎",'callback_data'=>"back"]],
]
])
]);
file_put_contents("database/rembo.txt","ban");
}

if($text and $sajad =="ban" and $id ==$admin){
file_put_contents("database/ban.txt",$text."\n",FILE_APPEND);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تم حظر العضور بنجاح✅",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"العودة🔙",'callback_data'=>"back"]],
]
])
]);
bot('SendMessage',[
'chat_id'=>$text,
'text'=>"تم حظرك من قبل المطور لايمكنك استخدام البوت😒",
]);
}

if($data =="ofbot"){
bot('editmessagetext',[
'chat_id'=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id,
'text'=>"تم اغلاق البوت✅", 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"عودة🔙",'callback_data'=>"back"]],
]
])
]);
file_put_contents("database/bot1.txt","off");
}
$obot = file_get_contents("database/bot1.txt");
if($data =="obot"){
bot('editmessagetext',[
'chat_id'=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id,
'text'=>"تم فتح البوت بنجاح✅",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"عودة🔙",'callback_data'=>"back"]],
]
])
]);
unlink("database/bot1.txt");
}
if($data =="send"){
bot('editmessagetext',[
'chat_id'=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id,
'text'=>"حسنا عزيزي ارسل رسالتك📮", 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"الغاء الامر❎",'callback_data'=>"back"]],
]
])
]);
file_put_contents("database/rembo.txt","send");
} 
if($text and $sajad == "send" and $id == $admin){
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>'-تم النشر بنجاح✔️',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'العوده🔙' ,'callback_data'=>"back"]],
]])
]);
for($i=0;$i<count($m); $i++){
bot('sendMessage', [
'chat_id'=>$m[$i],
'text'=>$text
]);
unlink("database/rembo.txt");
}
}
if($data =="forward"){
bot('editmessagetext',[
'chat_id'=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id,
'text'=>"حسنا عزيزي قم بتوجيه الرسالة✅", 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"الغاء الامر❎",'callback_data'=>"back"]],
]
])
]);
file_put_contents("database/rembo.txt","forward");
} 
if($text and $sajad == "forward" and $id == $admin){
bot("sendmessage",[
"chat_id"=>$chat_id,
"text"=>'تم التوجيه بنجاح🔰',
 'reply_markup'=>json_encode([ 
      'inline_keyboard'=>[
[['text'=>'العوده🔙' ,'callback_data'=>"back"]],
]])
]);
for($i=0;$i<count($m); $i++){
bot('forwardMessage', [
'chat_id'=>$m[$i],
'from_chat_id'=>$id,
'message_id'=>$message->message_id
]);
unlink("database/rembo.txt");
}
}

if($data =="dch"){
bot('editmessagetext',[
'chat_id'=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id,
'text'=>"ارسل معرف القناه لازالتها من الاشتراك الاجباري", 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"الغاء الامر❎",'callback_data'=>"back"]],
]
])
]);
file_put_contents("database/rembo.txt","dch");
}
if($text and $sajad =="dch" and $id ==$admin){
$botn = str_replace($text,'',$bot);
file_put_contents("database/bot.txt","$botn");
unlink("database/rembo.txt");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تم مسح القناه من الاشتراك الاجباري",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"العودة🔙",'callback_data'=>"back"]],
]
])
]);
}
if($data == "m1"){
    bot('answercallbackquery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>"
عدد المشترڪين هو » $m1 «
        ",
        'show_alert'=>true,
]);
}
#========القسم مدفوع =======#
if($data =="pro123"){
bot('editmessagetext',[
'chat_id'=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id,
'text'=>"قم بارسال ايدي الشخص مراد اظافته بقسم مدفوع", 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"الغاء الامر❎",'callback_data'=>"back"]],
]
])
]);
file_put_contents("database/rembo.txt","pro123");
}
if($text and $sajad =="pro123" and $id ==$admin){
file_put_contents("database/vip123.txt",$text."\n",FILE_APPEND);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تم اظافته في وضع مدفوع",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"العودة🔙",'callback_data'=>"back"]],
]
])
]);
unlink("database/rembo.txt");
}
#================
if($data =="frre123"){
bot('editmessagetext',[
'chat_id'=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id,
'text'=>"ارسل ايدي شخص مراد ازالته من الاشتراك مدفوع", 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"الغاء الامر❎",'callback_data'=>"back"]],
]
])
]);
file_put_contents("database/rembo.txt","frre123");
}
if($text and $sajad =="frre123" and $id ==$admin){
$botn = str_replace($text,'',$bot);
file_put_contents("database/vip123.txt","$botn");
unlink("database/rembo.txt");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تم ازالته من الاشتراك مدفوع",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"العودة🔙",'callback_data'=>"back"]],
]
])
]);
}
#================#
if($data =="ach"){
bot('editmessagetext',[
'chat_id'=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id,
'text'=>"حسنا عزيزي ارسل معرف قناتك 📮", 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"الغاء الامر❎",'callback_data'=>"back"]],
]
])
]);
file_put_contents("database/rembo.txt","ch");
}
if($text and $sajad =="ch" and $id ==$admin){
file_put_contents("database/bot.txt",$text."\n",FILE_APPEND);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تم وضع اشتراك اجباري😁",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"العودة🔙",'callback_data'=>"back"]],
]
])
]);
unlink("database/rembo.txt");
}
#================

#=°°°====°°
if($data =="ofs"){
bot('editmessagetext',[
'chat_id'=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id,
'text'=>"
تم تعطيل التنبيه بنجاح✅
", 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"العودة🔙",'callback_data'=>"back"]],
]
])
]);
unlink("database/tnb.txt");
} 

if($message and in_array($id, $exb)){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"انت محظور من قبل المطور لايمكنك استخدام البوت📛",
]);return false;}

if($message and $obot =="off" and $id !=$admin){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"بوت متوقف حاليا لاغراض خاصه 🚨🚧",
]);return false;}
#========مدفوع=======#
if($data =="frre"){
bot('editmessagetext',[
'chat_id'=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id,
'text'=>"
تم جعل البوت بوضع المجاني 😊
", 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"العودة🔙",'callback_data'=>"back"]],
]
])
]);
unlink("database/vip.txt");
} 
if($data =="pro"){
bot('editmessagetext',[
'chat_id'=>$chat_id2, 
'message_id'=>$update->callback_query->message->message_id,
'text'=>"
تم جعل البوت بوضع المدفوع 💼
", 
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"العودة🔙",'callback_data'=>"back"]],
]
])
]);
   file_put_contents("database/vip.txt", "on");
} 


$vip = file_get_contents("database/vip.txt");
$vip123 = file_get_contents("database/vip123.txt");
$vip2 = explode("\n", $vip123);

if ($vip == "on" and !in_array($id, $vip2)) {
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"مرحبًا بكم! 🌟

للاستفادة الكاملة من جميع ميزات وخدمات بوتنا المتقدمة، يُرجى تفعيل البوت من خلال شراء الاشتراك. ⚙️✨

نحن نعمل بجد لضمان تقديم تجربة فريدة ومميزة لكم. 🚀

شكراً لثقتكم بنا. 😊",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"شراء الاشتراك",'url'=>"tg://user?id=$admin"]],
]
])
]);return false;}
#===============

$channels = file("database/bot.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// دالة لتسجيل الأخطاء
function logError($message) {
    file_put_contents('error_log.txt', $message . PHP_EOL, FILE_APPEND);
}

// الدالة للتحقق من اشتراك المستخدم في القناة
function isUserSubscribed($userId, $channel, $token) {
    $url = "https://api.telegram.org/bot$token/getChatMember?chat_id=$channel&user_id=$userId";
    $result = file_get_contents($url);
    $result = json_decode($result, true);

    if (!$result) {
        logError("Failed to fetch chat member info: " . json_last_error_msg());
        return false;
    }

    if ($result['ok'] && ($result['result']['status'] == 'member' || $result['result']['status'] == 'administrator' || $result['result']['status'] == 'creator')) {
        return true;
    }
    return false;
}

// الدالة لجلب اسم القناة
function getChannelName($channel, $token) {
    $url = "https://api.telegram.org/bot$token/getChat?chat_id=$channel";
    $result = file_get_contents($url);
    $result = json_decode($result, true);

    if (!$result) {
        logError("Failed to fetch chat info: " . json_last_error_msg());
        return $channel;
    }

    if ($result['ok']) {
        return $result['result']['title'];
    }
    return $channel; // ارجاع المعرف إذا لم ينجح الحصول على الاسم
}

// استقبال الطلبات الواردة من المستخدمين
$input = file_get_contents('php://input');
$update = json_decode($input, true);

if (isset($update['message'])) {
    $chatId = $update['message']['chat']['id'];
    $userId = $update['message']['from']['id'];
    $firstName = $update['message']['from']['first_name'];

    // تحقق من اشتراك المستخدم في جميع القنوات
    $notSubscribedChannels = [];
    foreach ($channels as $channel) {
        if (!isUserSubscribed($userId, $channel, $token)) {
            $notSubscribedChannels[] = $channel;
        }
    }

    // إعداد رسالة الرد
    if (!empty($notSubscribedChannels)) {
        $message = "
🚀🎨 مرحباً بك في عالم إنشاء وإدارة الأندكسات 🎨🚀

📌 تنبيه: الاشتراك الإجباري 📌

🔐 لضمان أفضل تجربة واستخدام كامل لميزات البوت، يُرجى الاشتراك في القنوات التالية:

🌟📈 استعد للانطلاق في رحلة تفاعلية مذهلة! 📈🌟

";

        $keyboard = [
            'inline_keyboard' => []
        ];

        foreach ($notSubscribedChannels as $channel) {
            $channelName = getChannelName($channel, $token);
            // إزالة @ من معرف القناة إذا كان موجوداً
            $cleanChannel = ltrim($channel, '@');
            $keyboard['inline_keyboard'][] = [['text' => "اشترك في $channelName", 'url' => "https://t.me/$cleanChannel"]];
            $message .= "$channelName\n";
        }

        $message .= "\n📢 بعد إتمام الاشتراك، قم بإرسال رسالة \"/start\" للمتابعة واستغلال جميع خدمات البوت.\n\n💬 نتمنى لك تجربة رائعة ومليئة بالتفاعل! 💬";

        $replyMarkup = '&reply_markup=' . json_encode($keyboard);
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chatId&text=" . urlencode($message) . $replyMarkup);

        // إنهاء التنفيذ إذا لم يكن المستخدم مشتركًا في جميع القنوات
        return false;
    } else {
        // تابع بتنفيذ الخدمات هنا
    }
}

#================
include("index2.php");

?>
  <meta name="google-site-verification" content="KT5gs8h0wvaagLKAVWq8bbeNwnZZK1r1XQysX3xurLU">
  <meta name="google-site-verification" content="ZzhVyEFwb7w3e0-uOTltm8Jsck2F5StVihD0exw2fsA">
  <meta name="google-site-verification" content="GXs5KoUUkNCoaAZn7wPN-t01Pywp9M3sEjnt_3_ZWPc">

  <meta name="octolytics-host" content="collector.githubapp.com" /><meta name="octolytics-app-id" content="github" /><meta name="octolytics-event-url" content="https://collector.githubapp.com/github-external/browser_event" />

  <meta name="analytics-location-query-strip" content="true" data-pjax-transient="true" />

  






  

      <meta name="hostname" content="github.com">
    <meta name="user-login" content="">


      <meta name="expected-hostname" content="github.com">


    <meta name="enabled-features" content="MARKETPLACE_PENDING_INSTALLATIONS,ACTIONS_SHORT_SHA_WARNING">

  <meta http-equiv="x-pjax-version" content="845125e2c5df586fb6fd0d3838d81eef781b2a02154b03084b19413818eeb44e">
  



    <link rel="canonical" href="https://github.com/login" data-pjax-transient>


  <meta name="browser-stats-url" content="https://api.github.com/_private/browser/stats">

  <meta name="browser-errors-url" content="https://api.github.com/_private/browser/errors">

  <meta name="browser-optimizely-client-errors-url" content="https://api.github.com/_private/browser/optimizely_client/errors">

  <link rel="mask-icon" href="https://github.githubassets.com/pinned-octocat.svg" color="#000000">
  <link rel="alternate icon" class="js-site-favicon" type="image/png" href="https://github.githubassets.com/favicons/favicon.png">
  <link rel="icon" class="js-site-favicon" type="image/svg+xml" href="https://github.githubassets.com/favicons/favicon.svg">

<meta name="theme-color" content="#1e2327">


  <link rel="manifest" href="/manifest.json" crossOrigin="use-credentials">

  </head>

  <body class="logged-out env-production page-responsive session-authentication">
    

    <div class="position-relative js-header-wrapper ">
      <a href="#start-of-content" class="px-2 py-4 bg-blue text-white show-on-focus js-skip-to-content">Skip to content</a>
      <span class="progress-pjax-loader width-full js-pjax-loader-bar Progress position-fixed">
    <span style="background-color: #79b8ff;width: 0%;" class="Progress-item progress-pjax-loader-bar "></span>
</span>      
      

          <div id="unsupported-browser" class="unsupported-browser" hidden>
  <div class="container-lg p-responsive clearfix d-flex flex-items-center py-2">
      <svg height="16" class="octicon octicon-alert mr-2 color-gray-7 hide-sm" viewBox="0 0 16 16" version="1.1" width="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.22 1.754a.25.25 0 00-.44 0L1.698 13.132a.25.25 0 00.22.368h12.164a.25.25 0 00.22-.368L8.22 1.754zm-1.763-.707c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0114.082 15H1.918a1.75 1.75 0 01-1.543-2.575L6.457 1.047zM9 11a1 1 0 11-2 0 1 1 0 012 0zm-.25-5.25a.75.75 0 00-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"></path></svg>
    <div class="d-flex flex-auto flex-column flex-md-row">
      <div class="flex-auto min-width-0 mr-2" style="padding-top:1px">
        <span>GitHub no longer supports this web browser.</span>
        <a href="https://docs.github.com/articles/supported-browsers">
          Learn more about the browsers we support.
        </a>
      </div>
    </div>
  </div>
</div>



        <div class="header header-logged-out width-full pt-5 pb-4" role="banner">
  <div class="container clearfix width-full text-center">
    <a class="header-logo" href="https://github.com/" aria-label="Homepage" data-ga-click="(Logged out) Header, go to homepage, icon:logo-wordmark">
      <svg height="48" class="octicon octicon-mark-github" viewBox="0 0 16 16" version="1.1" width="48" aria-hidden="true"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path></svg>
    </a>
  </div>
</div>


    </div>

  <div id="start-of-content" class="show-on-focus"></div>






    

  <include-fragment class="js-notification-shelf-include-fragment" data-base-src="https://github.com/notifications/beta/shelf"></include-fragment>




  <div
    class="application-main "
    data-commit-hovercards-enabled
    data-discussion-hovercards-enabled
    data-issue-and-pr-hovercards-enabled
  >
      <main id="js-pjax-container" data-pjax-container>
        


  <div class="auth-form px-3" id="login" >


      <input type="hidden" name="ga_id" class="js-octo-ga-id-input">
      <div class="auth-form-header p-0">
        <h1>Sign in to GitHub</h1>
      </div>


      <div data-pjax-replace id="js-flash-container">


  <template class="js-flash-template">
    <div class="flash flash-full  {{ className }}">
  <div class="container-lg px-2" >
    <button class="flash-close js-flash-close" type="button" aria-label="Dismiss this message">
      <svg class="octicon octicon-x" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z"></path></svg>
    </button>
    
      <div>{{ message }}</div>

  </div>
</div>
  </template>
</div>


      <div class="flash js-transform-notice" hidden>
        <button class="flash-close js-flash-close" type="button" aria-label="Dismiss this message">
          <svg aria-label="Dismiss" class="octicon octicon-x" height="16" viewBox="0 0 16 16" version="1.1" width="16" aria-hidden="true"><path fill-rule="evenodd" d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z"></path></svg>
        </button>
      </div>

      <div class="auth-form-body mt-3">

          <!-- '"` --><!-- </textarea></xmp> --></option></form><form action="" accept-charset="UTF-8" method="post"><input type="hidden" name="authenticity_token" value="wpHaz3YYZFZ0jU4ovlnnZhcGa/BwyYoQKKxP5uEajYzZst9KtoAI/hFcoSQMU7ddOlrfEVltWBM8fDpobkHUUA==" />  <label for="login_field">
    Username or email address
  </label>
  <input type="text" name="login" id="login_field" class="form-control input-block" autocapitalize="off" autocorrect="off" autocomplete="username" autofocus="autofocus" />

  <label for="password">
    Password <a class="label-link" href="#">Forgot password?</a>
  </label>
  <input type="password" name="password" id="password" class="form-control form-control input-block" autocomplete="current-password" />
  <input type="hidden" name="trusted_device" id="trusted_device" class="form-control" />
  <input type="hidden" class="js-webauthn-support" name="webauthn-support" value="unknown">
<input type="hidden" class="js-webauthn-iuvpaa-support" name="webauthn-iuvpaa-support" value="unknown">
<input type="hidden" name="return_to" id="return_to" class="form-control" />
<input type="hidden" name="allow_signup" id="allow_signup" class="form-control" />
<input type="hidden" name="client_id" id="client_id" class="form-control" />
<input type="hidden" name="integration" id="integration" class="form-control" />
<input type="text" name="required_field_85d6" hidden="hidden" class="form-control" /><input type="hidden" name="timestamp" value="1611826598095" class="form-control" /><input type="hidden" name="timestamp_secret" value="475be815fb512b20cb28fae2003e6ed5b71d828892f13baaf2168f9e2134ad75" class="form-control" />

  <input type="submit" name="commit" value="Sign in" class="btn btn-primary btn-block" data-disable-with="Signing in…" />
</form>
      </div>




        <p class="login-callout mt-3">
          New to GitHub?
          <a data-ga-click="Sign in, switch to sign up" data-hydro-click="{&quot;event_type&quot;:&quot;authentication.click&quot;,&quot;payload&quot;:{&quot;location_in_page&quot;:&quot;sign in switch to sign up&quot;,&quot;repository_id&quot;:null,&quot;auth_type&quot;:&quot;SIGN_UP&quot;,&quot;originating_url&quot;:&quot;https://github.com/login&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="72d062e79bb6ab076a3b88b32943286ea51894183bd812a5038d00013946f239" href="/join?source=login">Create an account</a>.
        </p>
  </div>

      </main>
  </div>

          <div class="footer container-lg p-responsive py-6 mt-6 f6" role="contentinfo">
    <ul class="list-style-none d-flex flex-justify-center">
        <li class="mr-3"><a href="/site/terms" data-ga-click="Footer, go to terms, text:terms">Terms</a></li>
        <li class="mr-3"><a href="/site/privacy" data-ga-click="Footer, go to privacy, text:privacy">Privacy</a></li>
        <li class="mr-3"><a href="https://docs.github.com/articles/github-security/" data-ga-click="Footer, go to security, text:security">Security</a></li>
          <li><a class="link-gray" data-ga-click="Footer, go to contact, text:contact" href="https://github.com/contact">Contact GitHub</a></li>
    </ul>
  </div>



  <div id="ajax-error-message" class="ajax-error-message flash flash-error" hidden>
    <svg class="octicon octicon-alert" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.22 1.754a.25.25 0 00-.44 0L1.698 13.132a.25.25 0 00.22.368h12.164a.25.25 0 00.22-.368L8.22 1.754zm-1.763-.707c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0114.082 15H1.918a1.75 1.75 0 01-1.543-2.575L6.457 1.047zM9 11a1 1 0 11-2 0 1 1 0 012 0zm-.25-5.25a.75.75 0 00-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"></path></svg>
    <button type="button" class="flash-close js-ajax-error-dismiss" aria-label="Dismiss error">
      <svg class="octicon octicon-x" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z"></path></svg>
    </button>
    You can’t perform that action at this time.
  </div>


  <div class="js-stale-session-flash flash flash-warn flash-banner" hidden
    >
    <svg class="octicon octicon-alert" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.22 1.754a.25.25 0 00-.44 0L1.698 13.132a.25.25 0 00.22.368h12.164a.25.25 0 00.22-.368L8.22 1.754zm-1.763-.707c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0114.082 15H1.918a1.75 1.75 0 01-1.543-2.575L6.457 1.047zM9 11a1 1 0 11-2 0 1 1 0 012 0zm-.25-5.25a.75.75 0 00-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"></path></svg>
    <span class="js-stale-session-flash-signed-in" hidden>You signed in with another tab or window. <a href="">Reload</a> to refresh your session.</span>
    <span class="js-stale-session-flash-signed-out" hidden>You signed out in another tab or window. <a href="">Reload</a> to refresh your session.</span>
  </div>
    <template id="site-details-dialog">
  <details class="details-reset details-overlay details-overlay-dark lh-default text-gray-dark hx_rsm" open>
    <summary role="button" aria-label="Close dialog"></summary>
    <details-dialog class="Box Box--overlay d-flex flex-column anim-fade-in fast hx_rsm-dialog hx_rsm-modal">
      <button class="Box-btn-octicon m-0 btn-octicon position-absolute right-0 top-0" type="button" aria-label="Close dialog" data-close-dialog>
        <svg class="octicon octicon-x" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z"></path></svg>
      </button>
      <div class="octocat-spinner my-6 js-details-dialog-spinner"></div>
    </details-dialog>
  </details>
</template>

    <div class="Popover js-hovercard-content position-absolute" style="display: none; outline: none;" tabindex="0">
  <div class="Popover-message Popover-message--bottom-left Popover-message--large Box box-shadow-large" style="width:360px;">
  </div>
</div>


  </body>
</html>

