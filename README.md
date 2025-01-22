<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/Reyn12/manajemen-barang"><img src="https://img.shields.io/badge/status-development-yellow" alt="Status"></a>
<a href="https://github.com/Reyn12/manajemen-barang"><img src="https://img.shields.io/badge/version-1.0.0-blue" alt="Latest Version"></a>
<a href="https://github.com/Reyn12/manajemen-barang"><img src="https://img.shields.io/badge/laravel-10.0-red" alt="Laravel Version"></a>
<a href="https://github.com/Reyn12/manajemen-barang"><img src="https://img.shields.io/badge/license-MIT-green" alt="License"></a>
</p>

## About Manajemen Barang

Manajemen Barang is a modern inventory management system built with Laravel, offering an elegant and intuitive interface for managing your business inventory. We believe inventory management should be simple yet powerful. This system provides essential features such as:

- [Product Management] - CRUD operations for products with image handling.
- [Supplier Management] - Complete supplier information management system.
- [Transaction Tracking] - Real-time transaction monitoring and history.
- [Dashboard Analytics] - Comprehensive analytics and reporting system.
- [Export Features] - Export data to PDF and Excel formats.
- [Advanced Filtering] - Smart filtering and search capabilities.

## System Requirements

Before installing Manajemen Barang, make sure your server meets the following requirements:

- PHP >= 8.1
- MySQL >= 5.7
- Composer
- Node.js & NPM
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Installation Guide

```bash
# Clone the repository
git clone https://github.com/Reyn12/manajemen-barang.git

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