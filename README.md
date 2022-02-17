1 Измените параметры подключения к базе данных /config/config.php
2 настройте на nginx или apache поддержку ЧПУ
(пример на Nginx
 location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
)
3 установите пакеты composer


 
