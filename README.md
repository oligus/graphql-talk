# GraphQL talk

GraphQL talk and workshop files

https://github.com/donjajo/php-jsondb

## Install

#### Build container

_With make_
```bash
$ make build
$ make php-server
```

_Without make_
```bash
$ docker-compose -f docker-compose.yml up -d --build
$ docker-compose exec gql-cli bash -c "cd /var/www/html && php -S 0.0.0.0:80 -t /var/www/html/public"
```

