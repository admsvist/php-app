# Простой проект на PHP 8.2 использующий Composer и Docker

Этот проект создан для демонстрации использования PHP 8.2 вместе с Composer и Docker. Проект содержит простое
приложение, с минимальным роутингом.

## Зависимости

* PHP 8.2
* Composer
* Docker
* Docker Compose

## Установка

1. Склонируйте репозиторий:

```
git clone https://github.com/admsvist/php-app.git
```

2. Установите зависимости:

```
composer install
```

## Запуск приложения

Для запуска приложения вам понадобится Docker и Docker Compose.

1. Соберите образ Docker:

```
docker-compose build
```

2. Запустите контейнер:

```
docker-compose up -d
```

3. Перейдите по адресу http://localhost:80/ в вашем браузере, чтобы увидеть приложение.

## Остановка приложения

Для остановки приложения выполните следующую команду:

```
docker-compose down
```

## Лицензия

Этот проект распространяется под лицензией MIT.