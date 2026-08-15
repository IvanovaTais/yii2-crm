# Yii2 CRM

A simple CRM application built with PHP, Yii2 Advanced Framework, MySQL, and Docker.

## Features

- Client management (CRUD)
- Pagination
- Sorting
- Filtering
- Client form validation
- Flash messages
- REST API for clients
- API pagination, sorting, and filtering
- Client–Order relationships
- Foreign key constraints
- Cascade deletion of client orders
- Faker-based test data generation
- Dockerized development environment

## Tech Stack

- PHP 8.x
- Yii2 Advanced Framework
- MySQL
- Docker & Docker Compose
- Bootstrap 5
- REST API
- Faker
- Git

## Project Structure

The project is based on the Yii2 Advanced Application Template.

- `backend/` — web application and REST API
- `common/` — shared models and components
- `console/` — console commands and data generators
- `frontend/` — frontend application

## REST API

The project provides a REST API for working with clients.

### Clients

```http
GET /api/client
```

Supported features:

- Pagination
- Sorting
- Filtering

Example:
```http
GET /api/client?page=1&per-page=10
GET /api/client?sort=-created_at
GET /api/client?filter[id][gt]=15
GET /api/client?filter[first_name][like]=Padukirum&filter[status]=0
```

## Test Data Generation

Faker is used to generate test clients and orders.

Generate clients:
```php
php yii client/generate
```

Generate orders:
```php
php yii client-order/generate
```

A custom number of records can be specified:
```php
php yii client/generate 100
php yii client-order/generate 500
```

## Database

The application uses MySQL 8.

Main entities:

- `Client`
- `ClientOrder`

A client can have multiple orders.

`client_order.client_id` references `client.id` with `ON DELETE CASCADE`.

## Project Status

### Planned

- ⏳ Order CRUD
- ⏳ Authentication for REST API
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

Developed as a backend practice project focused on Yii2, REST API design, database relationships, validation, Docker, and modern PHP.