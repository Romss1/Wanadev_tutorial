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
	./bin/console doctrine:database:drop --force -n --if-exists --env=test
	./bin/console doctrine:database:create -n --env=test
	./bin/console doctrine:migrations:migrate -n --env=test
	./bin/console doctrine:fixtures:load -n --env=test
	./bin/phpunit

before-push: cs stan test
	echo 'OK'