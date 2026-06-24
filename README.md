<h1 align="center">PAYROLL System</h1>

<p align="center">
  <img src="https://img.shields.io/badge/version-2.0-6366f1?style=for-the-badge" alt="Version 2.0">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
 </p>

## Introduction

Payroll system using Laravel 12

## Features

| Module | Capabilities |
|---|---|
| **Dashboard** | Activity stats, productivity chart (last 14 days), upcoming reminders, recent tasks |
| **Employee** | CRUD, slug-based routing, employee, payment counting, progress tracking, status filter |
| **Profile** | Avatar, bio, contact info, password with strength meter |

### Prerequisites

- PHP 8.2 or higher
- Composer
- Laravel 12
- MySQL 8+ or any supported database
- Node.js & npm (for Vite asset compilation)

## Setup Instructions

### Step 1: Clone the Repository

```bash
[git clone https://github.com/Nukman-Sam/Laravel-Payroll-System.git)
cd Laravel-Payroll-System
```

### Step 2: Install Dependencies

```bash
composer install
npm install
```

### Step 3: Configure Environment Variables

```bash
cp .env.example .env
```

Update `.env` with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=payroll
DB_USERNAME=sail
DB_PASSWORD=password
```

### Step 4: Generate Application Key

```bash
php artisan key:generate
```

### Step 5: Run Migrations and Seed Database

```bash
php artisan migrate --seed
```

### Step 6: Serve the Application

```bash
php artisan serve
```

Open `http://localhost:8000` in your browser.



## Setup Instructions (Sail)

### Step 1: Clone the Repository

```bash
[git clone https://github.com/Nukman-Sam/Laravel-Payroll-System.git)
cd Laravel-Payroll-System
```

### Step 2: Install Dependencies

```bash
# Require the Sail package via Composer
composer require laravel/sail --dev
```


### Step 3: Configure Environment Variables

```bash
cp .env.example .env
```

Update `.env` with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=payroll
DB_USERNAME=sail
DB_PASSWORD=password
```

### Step 4: Publish Sail's Docker configuration file

```bash
php artisan sail:install

*** Choose mysql as database
```

### Step 5: Start Container

```bash
./vendor/bin/sail up -d

./vendor/bin/sail bash
```

### Step 6: Generate Application Key

```bash
php artisan key:generate
```

### Step 7: Run Migrations and Seed Database

```bash
php artisan migrate --seed
```

Open `http://localhost:8000` in your browser.

## Demo Login

```
Email:    admin@example.com
Password: secret
```

> Credentials are created by the seeder. Run `php artisan migrate:fresh --seed` to reset.


## Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** Blade templates, custom `cu-*` CSS design system, Bootstrap Icons, Vite
- **Database:** MySQL (compatible with PostgreSQL / SQLite)
- **Storage:** Laravel filesystem (public disk) for avatar and file uploads

