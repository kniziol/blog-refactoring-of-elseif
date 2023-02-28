# Refactoring of the `elseif` block code

## Docker

### Services Available

- `app` - PHP CLI
- `composer` - Composer

### Run service in Docker container

Run the `sh` shell:

```shell
docker compose run --rm app sh
```

Show Composer version:

```shell
docker compose run --rm composer -V
```

## Composer

### Add new package to project

```shell
docker compose run --rm composer require <vendor>/<package>
```

## PHPUnit

### Run tests with code coverage

```shell
docker compose run --rm app php -dxdebug.mode=coverage vendor/bin/phpunit --coverage-html coverage
```

## Infection - Mutation Testing

### Running tests

```shell
docker compose run --rm app php vendor/bin/infection
```
