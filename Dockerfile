FROM php:8.2-apache

# Копирование конфигурационного файла Apache в контейнер
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

# Устанавливаем зависимости для установки composer
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Устанавливаем composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Настраиваем Apache
RUN a2enmod rewrite

# Запуск Apache в фоновом режиме
CMD ["apache2-foreground"]