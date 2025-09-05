# استخدام صورة أساسية لـ PHP مع Apache
FROM php:8.2-apache

# نسخ ملفات تطبيقك إلى مجلد الخادم
COPY . /var/www/html/

# تعيين الأذونات المناسبة لمجلد الخادم (مهم للبعض)
RUN chown -R www-data:www-data /var/www/html
