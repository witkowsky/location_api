# Installation
```sh
$ composer intstall
```
# Database
create database schema and fill it
```sh
$ ./vendor/bin/doctrine-migrations migrate --configuration=config/migrations.yml
```

## Usage
```sh
$ php -S localhost:8080 -t public/
```
open localhost:8080 in web browser

## Endpoints
###fetch all locations 
GET /location 
optional
text=[string] 
distance=[int]

###create new location
POST /location 
name=[string]
address=[address]
latitude=[float]
longitude=[float]

###update location
POST /location/{id}
name=[string]
address=[address]
latitude=[float]
longitude=[float]

###remove location
DELETE /location/{id}

###get location
GET /location{id}

