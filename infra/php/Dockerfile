FROM php:7.4-fpm-buster
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

ENV \
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
	apt-get -y install git libicu-dev libonig-dev libzip-dev unzip locales && \
	apt-get clean && \
	rm -rf /var/lib/apt/lists/* && \
	locale-gen en_US.UTF-8 && \
	localedef -f UTF-8 -i en_US en_US.UTF-8 && \
	mkdir /var/run/php-fpm && \
	mkdir /var/log/php && \
	docker-php-ext-install intl pdo_mysql zip bcmath && \
	composer config -g process-timeout 3600 && \
	composer config -g repos.packagist composer https://packagist.org

COPY ./php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /work/backend
