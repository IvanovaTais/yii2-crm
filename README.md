# Yii2 CRM

A simple CRM application built with PHP, Yii2 Advanced Framework, MySQL, and Docker.

The project was created to practice backend development and demonstrate CRUD operations, pagination, sorting, Docker-based development, and Git workflow.

## Features

- Client management (Create, Read, Update, Delete)
- Client details page
- Pagination
- Column sorting
- Form validation
- Flash messages
- Test data generation with Faker
- Docker-based development environment

## Tech Stack

- PHP 8.x
- Yii2 Advanced Framework
- MySQL
- Docker & Docker Compose
- Bootstrap 5
- Git

## Project Status

### Completed

- ✅ Client CRUD
- ✅ Pagination
- ✅ Sorting
- ✅ Console command for generating fake clients
- ✅ Docker configuration
- ✅ Git feature branch workflow

### Planned

- ⏳ REST API
- ⏳ API validation
- ⏳ Authentication
- ⏳ OpenAPI / Swagger documentation

## Installation

### Clone the repository

```bash
git clone https://github.com/IvanovaTais/yii2-crm.git
cd yii2-crm
```

### Start Docker containers

```bash
docker compose up -d --build
```

### Install dependencies

```bash
docker compose exec frontend composer install
```

### Initialize the application

```bash
docker compose exec frontend php /app/init --env=Development --overwrite=All
```

### Apply database migrations

```bash
docker compose exec frontend php /app/yii migrate
```

## Screenshots

Coming soon.

## Author

Developed as a learning project to improve backend development skills with Yii2, Docker, and modern PHP.