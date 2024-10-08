# Label-Twinn

**Label-Twinn** is a Laravel-based application designed to generate and print blue labels for packaging products at **PT Tunas Widji Inti Nayottama**.

## Table of Contents
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Features
- Generate blue labels for product packaging.
- Customizable label format based on product details.
- Export and print labels in PDF format.
- User-friendly interface to manage label data.
  
## Requirements
Before you begin, ensure you have met the following requirements:
- **PHP** >= 8.0
- **Composer** (PHP Dependency Manager)
- **Laravel** 9.x
- **MySQL** (or any other supported database)
- **Node.js** & **NPM** for frontend assets
- A web server such as **Apache** or **Nginx**

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
   ```bash
   cp .env.example .env
- Update the following fields in .env:
- Database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
- Other environment-specific settings
