#!/usr/bin/env bash

php Tests/Fixtures/App/app/console doctrine:schema:drop --force
php Tests/Fixtures/App/app/console doctrine:database:drop --force
php Tests/Fixtures/App/app/console doctrine:database:create
php Tests/Fixtures/App/app/console doctrine:schema:create
php Tests/Fixtures/App/app/console khepin:yamlfixtures:load

