<p align="center"><kbd><img src="https://raw.githubusercontent.com/bubblevy/laravel-filament-starter/main/public/image.png" width="100%" alt="Laravel Filament Starter"></kbd></p>

## About

<b>Starter project</b> for building modern admin panels using Laravel 12 and Filament 4.

## Installation

#### 1. Clone the repository

```sh
git clone https://github.com/bubblevy/laravel-filament-starter.git
```

#### 2. Copy .env

```sh
cp .env.example .env
```

#### 3. Configure .env

```sh
FILESYSTEM_DISK=public
```

#### 4. Install depedencies

```sh
composer install
npm install
```

#### 5. Generate Key

```sh
php artisan key:generate
```

#### 6. Run Symlink

```sh
php artisan storage:link
```

#### 7. Migrate database

```sh
php artisan migrate
```

#### 8. Database seeders

```sh
php artisan db:seed
```

#### 9. Run the development server

```sh
npm run dev
```

#### 10. Run application

```sh
php artisan serve
```

#### <i><b>Open http://localhost:8000/admin Note. username: admin & password: @Admin123</b></i>
