# Install

### Create .env
```shell
cp ./src/.env.example ./src/.env
```

### Docker
```shell
docker-compose up -d --no-deps --build
```
---
## Project init
```shell
docker exec -i laravel_test_php npm run build
```
```shell
docker exec -i laravel_test_php php artisan migrate:fresh --seed --seeder=CreateApiUserSeeder
```
### Import products
```shell
docker exec -i laravel_test_php php artisan import:products
```
### Import product stocks
```shell
docker exec -i laravel_test_php php artisan import:product-stocks
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