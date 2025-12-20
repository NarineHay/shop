#!/bin/sh
set -e
# Устанавливаем права
chown -R www-data:www-data storage bootstrap/cache

# Генерируем ключ, если нет
if [ ! -f /var/www/.env ]; then
  cp /var/www/.env.example /var/www/.env
  php artisan key:generate
fi


exec "$@"
