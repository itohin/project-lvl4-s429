install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR12 routes app tests

test:
	composer run-script phpunit tests

run:
	php -S localhost:8000 -t public
