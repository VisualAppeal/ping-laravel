#!/bin/bash
forever start -l ./ping.log -e ./ping_error.log --pidFile queue.pid -a /usr/bin/php artisan queue:listen
