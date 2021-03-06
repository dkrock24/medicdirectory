#!/bin/bash
cd "$(dirname "$0")";
git pull -f origin master && \
composer update && \
php bin/console assets:install --symlink && \
php bin/console doctrine:schema:update --force --dump-sql && \
php bin/console cache:clear --env=dev && \
php bin/console cache:clear --env=prod && \
chown -R www-data:www-data web/uploads && \
chmod -R og+srw web/uploads
chmod -R a+srw var
