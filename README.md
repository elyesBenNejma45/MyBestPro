# MyBestPro

## Requirements
- symfony 4.1.*
- PHP 7.2
- Mysql 5.7
- composer 1.6.5
## Migrations: Creating the Database and Tables
- php bin/console doctrine:database:create
-  php bin/console doctrine:schema:create
-  php bin/console make:migration
- php bin/console doctrine:migrations:migrate

## Project Run
- php bin/console server:run

## Project Paths
- / : taches list
- /tache: list search 

