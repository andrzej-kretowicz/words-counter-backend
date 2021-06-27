### Steps to run project with `docker-compose`
1. Build & run docker images with:
```shell
docker-compose up
```

2. Copy `.env.example` to `.env`

3. Install composer dependencies
```shell
docker-compose exec app composer install
```

4. Create database:
```shell
docker-compose exec app php bin/console doctrine:database:create
```

5. Run migrations:
```shell
docker-compose exec app php bin/console d:m:m
```
