# Project guide

## Overview

This repository is a multilingual e-commerce application built with Laravel 12,
Inertia 2, Vue 3, Filament 3, and MySQL 8. The storefront supports Armenian,
Russian, and English (`hy`, `ru`, `en`); `/` redirects to `/hy`. Filament is
mounted at `/admin`.

## Runtime and local environment

- PHP runs in Docker from `php:8.5.12-fpm`.
- Nginx proxies the application; its selected config comes from
  `docker/nginx/${NGINX_CONF}`.
- MySQL uses the `mysql:8.0` image and the named `dbdata` volume.
- Node.js 20 and Composer 2 are installed in the PHP image.
- Vite listens on `0.0.0.0:5173`; its entry point is `resources/js/app.js`.
- Docker startup is defined in `docker-compose.yml`, and the PHP container
  startup behavior is in `docker/php/entrypoint.sh`.

The Composer constraint (`php: ^8.2`) is a compatibility floor, not the Docker
runtime version. The exact runtime version is pinned in `docker/php/Dockerfile`.

## Application structure

- `routes/web.php`: localized storefront routes, checkout, contact, portfolio,
  cart, comparison, products, and auth inclusion.
- `routes/api.php`: API routes, including cart/product endpoints.
- `app/Http/Controllers`: web, API, authentication, profile, and address
  controllers.
- `app/Services`: application/business logic. Product filtering and imports are
  centered in `app/Services/Products`.
- `app/Repositories` and `app/Interfaces`: repository abstraction layer. The
  bindings live in `app/Providers/AppServiceProvider.php`.
- `app/Models`: catalog, attributes, carts, orders, payments, portfolios,
  regions, users, and translations.
- `app/Filament/Resources`: administration resources.
- `resources/js/Pages`: Inertia/Vue pages; shared Vue UI is in
  `resources/js/Components` and Pinia stores are in `resources/js/Stores`.
- `database/migrations` and `database/seeders`: MySQL schema and seed data.
- `lang`: application translations.

Localization is URL-based and is applied by
`app/Http/Middleware/SetLocale.php`. Translated domain data is stored in
dedicated translation models/tables.

## Common commands

Run the application through Docker unless a task explicitly requires the host
toolchain:

```bash
docker compose up --build
docker compose exec app php artisan migrate
docker compose exec app npm run dev
```

The Composer `dev` script starts the Laravel server, queue listener, and Vite.
The repository also has PHPUnit feature/unit tests and Laravel Pint, but run
them only when the task calls for validation.

## Working notes

- Never commit or expose `.env`; use `.env.example` when documenting variables.
- Treat `vendor`, `node_modules`, `public/build`, and published Filament assets
  under `public/{css,js}/filament` as generated/dependency output unless the
  task explicitly targets them.
- Preserve the locale prefix when adding storefront routes or links.
- Keep database access behind the existing service/repository pattern where it
  is already used, and register new interface bindings in `AppServiceProvider`.
- Product import integrates with Google Sheets and remote image downloads; be
  careful not to trigger external imports during unrelated work.
- The entrypoint changes permissions recursively in `storage` and
  `bootstrap/cache`; avoid running it on the host by accident.
