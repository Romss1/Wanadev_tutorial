.PHONY: start stop stan cs-fix test before-push

install:
	docker-compose -f ../docker-compose.yml build
	composer install

start:
	docker-compose -f ../docker-compose.yml up -d

stop:
	docker-compose -f ../docker-compose.yml stop

stan:
	./vendor/bin/phpstan analyze -c phpstan.neon

cs:
	./vendor/bin/php-cs-fixer fix --diff --dry-run

cs-fix:
	./vendor/bin/php-cs-fixer fix

test:
	./bin/phpunit

before-push: cs stan test
	echo 'OK'