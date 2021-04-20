# Books Search

## Gettings started

```bash
cd docker
```

Start the containers

```bash
docker-composer up -d
```

Run the migrations

```bash
docker-compose exec php-fpm php app/Console/main.php migrate-db
```

Visit http://localhost:8080
