### Installation
```sh
$ composer intstall
```
### Database
create database schema and fill it
```sh
$ ./vendor/bin/doctrine-migrations migrate --configuration=config/migrations.yml
```