.DEFAULT_GOAL := setup

.PHONY: install
install:
	composer install

.PHONY: test
test:
	php vendor/bin/phpunit

.PHONY: clean
clean:
	rm -rf vendor/
