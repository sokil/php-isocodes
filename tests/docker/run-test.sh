#!/usr/bin/env bash

PROJECT_DIR=$(dirname $(readlink -f $0))/../..

PHP_VERSION=$1
if [[ -z $PHP_VERSION ]]; then
    PHP_VERSION=7.1
fi

docker run \
    --rm \
    -v $PROJECT_DIR:/php-isocodes \
    -v $PROJECT_DIR/tests/docker/docker-php-entrypoint:/usr/local/bin/docker-php-entrypoint \
    php:$PHP_VERSION
