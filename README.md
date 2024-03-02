# Microservices Application

This repository contains a Laravel-based microservices application with two modules: "Users" and "Notifications." The modules communicate through a message broker.

## Table of Contents

- [Cloning the Repository](#cloning-the-repository)
- [Running Docker Containers](#running-docker-containers)
- [Running Tests](#running-tests)
- [Endpoints Documentation](#endpoints-documentation)
- [License](#license)

## Cloning the Repository

To clone this repository, use the following commands:

```bash
git clone https://github.com/theridwanoladapo/microservices.git
cd microservices
```

## Running the Docker

To build and run the Docker Containers

```bash
docker-compose up -d --build
docker-compose exec web php artisan migrate
docker-compose exec web php artisan queue:work
```

## Running Tests
```bash
docker-compose exec web php artisan test

docker-compose exec users-service php artisan dusk
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
