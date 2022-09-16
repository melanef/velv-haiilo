# Velv Challenge - Haiilo

## Requirements

- Docker + Docker Compose

## Installation

1. Clone this repository and navigate into it
2. Run the container environment installation: `docker-compose up -d`
3. Execute the backend dependencies installation: `docker exec haiilo-backend-php composer install`

## Usage

The backend provides a CLI application that can be executed running the command below:

```docker exec haiilo-backend-php php artisan import:prepare {path to input file}```

Please note that the file must be accessible on the Docker environment. This can be easily accomplished by storing the input file on the directory `src/backend`.
Adding a volume mapping to the docker-compose file can also solve this. The output will be generated on `src/backend/storage/app/prepared`.

## Tests

There are unit tests and application tests for the backend. Run them using the docker environment:

```docker exec haiilo-backend-php vendor/bin/phpunit```
