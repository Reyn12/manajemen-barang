
## System Requirements

Before installing Manajemen Barang, make sure your server meets the following requirements:

- PHP >= 8.1
- MySQL >= 5.7
- Composer

## Installation Guide

```bash
# Clone the repository
git clone https://github.com/Reyn12/manajemen-barang.git

Rename ".env-example" jadi ".env"

# Navigate to project directory
cd manajemen-barang

# Install PHP dependencies
composer install

# Install NPM packages
npm install

# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations and seeders
php artisan migrate --seed

# Create storage link
php artisan storage:link

# Build assets
npm run dev

# Start the server
php artisan serve

# PDF Generation
composer require barryvdh/laravel-dompdf

# Excel Export
composer require maatwebsite/excel

# Sweet Alert
composer require realrashid/sweet-alert

```
