#!/bin/bash

cd /var/www/computersciencegenius.com/subdomains/ping;
php artisan queue:listen
