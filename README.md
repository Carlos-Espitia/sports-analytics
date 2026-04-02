# Sports Analytics

A soccer analytics web application built with Laravel, Inertia.js, React, Tailwind CSS, and MariaDB — running locally via Docker.

## Stack

- **Backend:** PHP 8.2, Laravel 10
- **Frontend:** React 18, Inertia.js, Tailwind CSS, Vite
- **Database:** MariaDB 11
- **Local dev:** Docker + Docker Compose

## Requirements

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- [Node.js](https://nodejs.org/) (v18+)
- [Composer](https://getcomposer.org/)

## Local Setup

### 1. Clone the repo

```bash
git clone <repo-url>
cd sports-analytics
```

### 2. Configure environment

```bash
cp .env.example .env
```

Update the following values in `.env`:

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=sports_analytics
DB_USERNAME=laravel
DB_PASSWORD=secret
```

### 3. Install PHP dependencies

```bash
composer install
```

### 4. Install JS dependencies

```bash
npm install
```

### 5. Start Docker containers

```bash
docker compose up -d
```

This starts the Laravel app on `http://localhost:8000` and MariaDB on port `3306`.

### 6. Generate app key

```bash
docker compose exec app php artisan key:generate
```

### 7. Run database migrations

```bash
docker compose exec app php artisan migrate
```

### 8. Start the Vite dev server

```bash
npm run dev
```

Visit `http://localhost:8000`.

## Common Commands

```bash
# Start containers
docker compose up -d

# Stop containers
docker compose down

# Run migrations
docker compose exec app php artisan migrate

# Rollback last migration batch
docker compose exec app php artisan migrate:rollback

# Open a shell inside the app container
docker compose exec app bash

# View app logs
docker compose logs app
```
