.DEFAULT_GOAL := help

VENDOR_BIN = vendor/bin

quality: phpcs phpunit phpspec ## Check code quality and tests pass

help: ## Prints help for targets with comments
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

phpspec: ## Run PHP specification tests
	${VENDOR_BIN}/phpspec run --no-code-generation

phpunit: ## Run PHP unit tests
	${VENDOR_BIN}/phpunit

phpcs: ## Check PHP code style
	${VENDOR_BIN}/phpcs -n --standard=PSR2 src

phpcs-fixer: ## Fix PHP code style
	${VENDOR_BIN}/phpcbf -n --standard=PSR2 src
