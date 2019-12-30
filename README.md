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
request: GET /location 
optional params:
text=[string] 
distance=[int]
response: 
```json
{"data":[{"id":1,"name":"Home.pl","address":"Zbo\u017cowa 4, Szczecin","latitude":53.4224,"longitude":14.5635,"distance":0}],"error":null}
```

###create new location
request: POST /location
params: 
name=[string]
address=[address]
latitude=[float]
longitude=[float]
response: 
```json
{"data":{"id":5},"error":null}
```

###update location
POST /location/{id}
name=[string]
address=[address]
latitude=[float]
longitude=[float]
```json
{"data":{"id":1,"name":"Home.pl","address":"Zbo\u017cowa 4, Szczecin","latitude":53.4224,"longitude":14.5635,"distance":0},"error":null}
```

###remove location
DELETE /location/{id}
```json
{"data":[],"error":null}
```
###get location
GET /location{id}
```json
{"data":{"id":1,"name":"Home.pl","address":"Zbo\u017cowa 4, Szczecin","latitude":53.4224,"longitude":14.5635,"distance":0},"error":null}
```

# Known bugs
1. better to dont delete homepl entity (calculate distance depends on it)
2. front can send "null" string as parameter in create (this is not validated).
3. I wanted to format code with code sniffer, but php storm doesnt work with code sniffer on windows right now.