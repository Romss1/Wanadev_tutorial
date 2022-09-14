.PHONY: build start stop stan cs-fix test before-push

DOCKER_PHP_ROOT=docker exec -it wanadev-php
DOCKER_PHP=docker exec -it -u www-data wanadev-php

build:
	docker-compose -f ../docker-compose.yml build

install: build start
	$(DOCKER_PHP_ROOT) chown 1000:www-data -R /var/www/
	$(DOCKER_PHP_ROOT) chmod 775 -R /var/www/
	$(DOCKER_PHP) composer install
	$(DOCKER_PHP) ./bin/console doctrine:migrations:migrate -n

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
	$(DOCKER_PHP) ./bin/console doctrine:database:drop --force -n --if-exists --env=test
	$(DOCKER_PHP) ./bin/console doctrine:database:create -n --env=test
	$(DOCKER_PHP) ./bin/console doctrine:migrations:migrate -n --env=test
	$(DOCKER_PHP) ./bin/console doctrine:fixtures:load -n --env=test
	$(DOCKER_PHP) ./bin/phpunit

before-push: cs stan test
	echo 'OK'