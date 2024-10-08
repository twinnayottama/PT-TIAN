# Label-Twinn

**Label-Twinn** adalah aplikasi berbasis Laravel yang dirancang untuk menghasilkan dan mencetak label biru untuk produk kemasan di **PT Tunas Widji Inti Nayottama**.

## Table of Contents
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Features
- Membuat label biru untuk kemasan produk.
- Format label yang dapat disesuaikan berdasarkan detail produk.
- Mengekspor dan mencetak label dalam format PDF.
- Antarmuka yang mudah digunakan untuk mengelola data label.
  
## Requirements
Sebelum memulai, pastikan Anda telah memenuhi persyaratan berikut:
- **PHP** >= 8.0
- **Composer** (PHP Dependency Manager)
- **Laravel** 10.x
- **MySQL** (or any other supported database)
- A web server such as **Apache** with **Laragon**

## Installation
Follow these steps to install the project locally:

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/your-username/label-twinn.git
   cd label-twinn
2. **Install Dependencies:**
   - **Install PHP dependencies via Composer:**
     ```bash
     composer install
   - **Install frontend dependencies using NPM:**
      ```bash
     npm install && npm run dev
3. **Set Up Environment: Copy the .env.example to create a .env file:**
   - **Set Up Environment**
     ```bash
     cp .env.example .env
   - **Update the following fields in .env:**
     - Database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
     - Other environment-specific settings
4. **Generate Application Key:**
   ```bash
   php artisan key:generate
5. **Migrate the Database: Run migrations to create the required database tables:**
   ```bash
   php artisan migrate
6. **Seed Database (Optional): If you want to populate the database with some initial data:**
   ```bash
   php artisan db:seed
7. **php artisan serve**
   ```bash
   php artisan serve


