#!/bin/bash
forever start -l ./ping.log -e ./ping_error.log -a /usr/bin/php artisan queue:listen