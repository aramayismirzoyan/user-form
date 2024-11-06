# Форма добавления пользователя

## Запуск

### Связь с базой данных

Пропишите в файле config/db.php данные для доступа к БД

### Настройка всех запросов на index.php

Для того чтобы приложение работало корректно нужно все приходящие запросы направить на index.php

#### Для Nginx

Добавьте эту настройку в виртуальный хост Nginx

~~~
location / {
        try_files $uri $uri/ /index.php?$query_string;
}
~~~

#### Для Apache

В корневой папке проекта создайте файл именем .htaccess с этим содержанием

~~~
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>
    RewriteEngine On
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
~~~

### Установка зависимостей

~~~
composer update
~~~

### SQL для создания таблицы users 

~~~
create table users
(
    id    SERIAL PRIMARY KEY  not null,
    name  VARCHAR(50)         not null,
    email VARCHAR(50) UNIQUE not null,
    age   integer             not null
);
~~~

### Запуск формы

Форма находится на главной странице