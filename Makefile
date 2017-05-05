.PHONY: help install tests-unit

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: composer.lock ## Install dependencies

composer.lock: composer.json
	composer update

test-unit: install ## Run unit tests
	vendor/bin/phpunit
