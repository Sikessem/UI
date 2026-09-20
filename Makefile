.PHONY: install install-js install-php check fix build test debug

install: install-js install-php

install-js: node_modules bun.lock

node_modules: package.json packages/ui/package.json
	bun i

bun.lock: package.json packages/ui/package.json
	bun update

install-php: vendor composer.lock

vendor: composer.json
	composer i

composer.lock: composer.json
	composer up

check: install
	pnpm check
	composer check

IS_CI ?= $(CI)

fix: install
	bun fix
	[ "$(IS_CI)" != "true" ] && composer fix || true

build: fix
	bun run build

test: install
	bun run test
	composer test

debug: install
	bun debug
	composer debug
