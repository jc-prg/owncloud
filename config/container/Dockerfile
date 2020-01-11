FROM php:7.3-apache

# source: https://github.com/docker-library/owncloud
# -> Update to php7.3, oc 10.3.x (version via ARG in docker-compose.yml)
# -> see https://owncloud.org/download/ to change version and SHA256

ARG OWNCLOUD_VERSION
ARG OWNCLOUD_SHA256
RUN env

# install required software
RUN apt-get update && apt-get upgrade
RUN apt-get install -y --no-install-recommends \
                bzip2 \
                gnupg dirmngr \
#                libcurl4-openssl-dev \
                libfreetype6-dev \
                libicu-dev \
                libjpeg-dev \
                libldap2-dev \
                libmemcached-dev \
                libpng-dev \
                libpq-dev \
                libxml2-dev \
                libzip-dev \
                unzip \
        && rm -rf /var/lib/apt/lists/*

# install required PHP modules
RUN set -ex; \
        docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr; \
        debMultiarch="$(dpkg-architecture --query DEB_BUILD_MULTIARCH)"; \
        docker-php-ext-configure ldap --with-libdir="lib/$debMultiarch"; \
        docker-php-ext-install -j "$(nproc)" \
                exif \
                gd \
                intl \
                ldap \
                opcache \
                pcntl \
                pdo_mysql \
                pdo_pgsql \
                pgsql \
                zip

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
                echo 'opcache.memory_consumption=128'; \
                echo 'opcache.interned_strings_buffer=8'; \
                echo 'opcache.max_accelerated_files=4000'; \
                echo 'opcache.revalidate_freq=60'; \
                echo 'opcache.fast_shutdown=1'; \
                echo 'opcache.enable_cli=1'; \
        } > /usr/local/etc/php/conf.d/opcache-recommended.ini
RUN a2enmod rewrite


# PECL extensions
RUN set -ex; \
        pecl install APCu-5.1.18; \
        pecl install memcached-3.1.5; \
        pecl install redis-5.1.1; \
        docker-php-ext-enable \
                apcu \
                memcached \
                redis 


VOLUME /var/www/html

RUN set -eux; \
       curl -fL -o owncloud.tar.bz2 "https://download.owncloud.org/community/owncloud-${OWNCLOUD_VERSION}.tar.bz2"; \
       curl -fL -o owncloud.tar.bz2.asc "https://download.owncloud.org/community/owncloud-${OWNCLOUD_VERSION}.tar.bz2.asc"; \
       echo "$OWNCLOUD_SHA256 *owncloud.tar.bz2" | sha256sum -c -; \
       export GNUPGHOME="$(mktemp -d)"; \ 
# gpg key from https://owncloud.org/owncloud.asc
       gpg --batch --keyserver ha.pool.sks-keyservers.net --recv-keys E3036906AD9F30807351FAC32D5D5E97F6978A26; \
       gpg --batch --verify owncloud.tar.bz2.asc owncloud.tar.bz2; \
       command -v gpgconf && gpgconf --kill all || :; \
       rm -r "$GNUPGHOME" owncloud.tar.bz2.asc; \
       tar -xjf owncloud.tar.bz2 -C /usr/src/; \
       rm owncloud.tar.bz2

WORKDIR /var/www/html


COPY docker-entrypoint.sh /usr/local/bin/
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]

