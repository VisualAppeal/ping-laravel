.PHONY: configure install update migrate reset refresh seed

install:
	@curl -sS https://getcomposer.org/installer | php
	@./composer.phar install
	@npm install
	@./node_modules/bower/bin/bower install
	@echo "All dependencies installed."

	@echo "Database set up."

update:
	@./composer.phar self-update
	@./composer.phar update
	@npm update
	@./node_modules/bower/bin/bower update
	@echo "All dependencies updated."
	@php artisan migrate
