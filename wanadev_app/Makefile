.PHONY: start stop stan test before-push

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

test:
	./bin/phpunit

before-push: cs stan test
	echo 'OK'