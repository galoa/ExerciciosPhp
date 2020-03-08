# ExerciciosPhp

This application uses [docker](https://docs.docker.com/install/) and [docker-compose](https://docs.docker.com/compose/install/) to facilitate its execution.

if any test is changed you need to execute the command below, run:

```sh
docker-compose up --build
```

To perform unit tests run:

```sh
docker-compose run php vendor/bin/phpunit
```
