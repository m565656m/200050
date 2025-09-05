# إذا كان بوتك مكتوبًا بـ Node.js
FROM node:18-alpine
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
CMD ["node", "bot.js"]

# أو إذا كان بوتك مكتوبًا بـ Python
FROM python:3.9-slim
WORKDIR /app
COPY requirements.txt .
RUN pip install -r requirements.txt
COPY . .
CMD ["python", "bot.py"]

# أو إذا كان بوتك مكتوبًا بـ PHP
FROM php:8.2-apache
WORKDIR /var/www/html
COPY . .
CMD ["apache2-foreground"]
