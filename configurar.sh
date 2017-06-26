#!/bin/bash
set -x
cd "$(dirname "$0")";
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force --dump-sql
php bin/console doctrine:fixtures:load --purge-with-truncate --no-interaction
php bin/console admin:generar-ubicaciones-elsalvador
hp bin/console admin:generar-clientes-prueba 500
php bin/console admin:generar-medicos-prueba 500
set +x