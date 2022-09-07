# export
DOCKER_COMPOSE_PATH := ./
DOCKER_COMPOSE_BINARY := docker compose
PHP_COMPOSE_SERVICE := php-fpm

# make setup
SHELL := /bin/bash
MAKE := @make --no-print-directory -s
DOCKER_COMPOSE_PATH := $(realpath $(DOCKER_COMPOSE_PATH))
DOCKER_COMPOSE_BINARY := $(DOCKER_COMPOSE_BINARY)

# docker
.PHONY: docker-compose
docker-compose:
	cd $(DOCKER_COMPOSE_PATH) && $(DOCKER_COMPOSE_BINARY) $(CMD)

.PHONY: docker-build
docker-build:
	$(MAKE) docker-compose CMD="build"

.PHONY: docker-start
docker-start:
	$(MAKE) docker-compose CMD="up -d"

.PHONY: docker-login
docker-login:
	echo $(PHP_COMPOSE_SERVICE)
	$(MAKE) docker-compose CMD="exec $(PHP_COMPOSE_SERVICE) bash -l"

.PHONY: docker-stop
docker-stop:
	$(MAKE) docker-compose CMD="down"

.PHONY: docker-compose-service-php
docker-compose-service-php:
	$(MAKE) docker-compose CMD="exec $(DC_ARGS) -w /home/data/data -u1000 $(PHP_COMPOSE_SERVICE) $(CMD)"

# composer
.PHONY: setup
setup: composer-install

.PHONY: composer-install
composer-install:
	$(MAKE) docker-compose-service-php CMD="composer install"

.PHONY: composer-update-lock
composer-update-lock:
	$(MAKE) docker-compose-service-php CMD="composer update --lock"

.PHONY: composer-update
composer-update:
	$(MAKE) docker-compose-service-php CMD="composer update"