#!/bin/bash

cd /usr/share/caddy/wechat.mooibay.com/
git pull
composer install
composer dump-autoload
php artisan config:cache