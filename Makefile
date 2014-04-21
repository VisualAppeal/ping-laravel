.PHONY: configure install update migrate reset refresh seed

build: build_less build_js
	@echo "Done."

build_less:
	@echo "Compiling less files..."
	@./node_modules/less/bin/lessc --yui-compress ./public/less/main.less > \
		./public/css/main.min.css

build_js:
	@echo "Minfying javascripts..."
	@./node_modules/uglify-js/bin/uglifyjs -o public/js/main.min.js \
		public/js/main.js

configure:
	@chmod 777 -R app/storage/cache
	@chmod 777 -R app/storage/logs
	@chmod 777 -R app/storage/meta
	@chmod 777 -R app/storage/sessions
	@chmod 777 -R app/storage/views
	@echo "Directory rights set."

install:
	@curl -sS https://getcomposer.org/installer | php
	@./composer.phar install
	@npm install
	@./node_modules/bower/bin/bower install
	@echo "All dependencies installed."
	@php artisan migrate --package=cartalyst/sentry
	@php artisan migrate
	@php artisan db:seed --class="InstallSeeder"
	@echo "Database set up."

update:
	@./composer.phar self-update
	@./composer.phar update
	@npm update
	@./node_modules/bower/bin/bower update
	@echo "All dependencies updated."
	@php artisan migrate

migrate:
	@php artisan migrate --package=cartalyst/sentry
	@php artisan migrate

reset:
	@php artisan migrate:reset

refresh:
	@php artisan migrate:reset
	@php artisan migrate
	@php artisan db:seed --class=DevelopmentSeeder

seed:
	@php artisan db:seed --class=DevelopmentSeeder