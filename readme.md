# Blog

Blog is a website that presents articles on various topics.

## Development environment

### Pre-requisites

* PHP 8.2
* Composer
* Symfony CLI
* Docker & Docker-compose

You can check the prerequisites (except Docker and Docker-compose) with the following command (from the Symfony CLI):

```bash
symfony check:requirements
```

### Launch the development environment

```bash
docker-compose up -d
```

## Run tests

```bash
php bin/phpunit --testdox
```