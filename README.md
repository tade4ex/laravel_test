# Install

### Docker
```shell
docker-compose up -d --no-deps --build
```
---
## Project init
```shell
cp .env.example .env
```
```shell
composer install
```
```shell
php artisan migrate:fresh --seed --seeder=CreateApiUserSeeder
```
### Import products
```shell
php artisan import:products
```
### Import product stocks
```shell
php artisan import:product-stocks
```
---
## Project web url
```
http://localhost:8888
```
---
## API TEST

### Login
```shell
curl -X POST -H "Content-Type: application/json" -d '{"email": "test@email.com","password": "Api12345"}' http://localhost:8888/api/login
```

### Product list
```shell
curl -X GET -H "Authorization: Bearer token" http://localhost:8888/api/products
```