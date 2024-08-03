# RestaurantCashier-exampleApp Management System

A web application built with Laravel for managing restaurant menus, transactions, and user accounts. It allows users to view and manage menu items, track transactions, and handle user accounts with roles and permissions.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)

## Features

- **User Management**: Manage user accounts, including roles (admin or regular user).
- **Menu Management**: Add, edit, and delete menu items.
- **Transaction History**: View transaction history with details of items purchased.
- **Responsive Design**: Mobile-friendly interface using Tailwind CSS and Flowbite.

## Requirements

- PHP >= 8.2 (i've use 8.3)
- Laravel >= 11
- in this project i use SQLite
- Composer

## Installation

1. **Clone the Repository**



2. **Install Dependencies**

    ```sh
    composer install
    ```
    or update if needed

5. **Run Migrations**

    ```sh
    php artisan migrate
    ```

6. **Seed the Database**

    I have seeder and factory for each table, so better add seed

    ```sh
    php artisan db:seed
    ```

7. **Start the Development Server**

    ```sh
    php artisan serve
    ```
    and/or
    ```
    npm run dev
    ```
    because this project using tailwind

## Configuration

1. **Database Configuration**

    Database are default using SQLite in `.env` file with your database connection details:

    ```env
    DB_CONNECTION=sqlite
    # DB_HOST=127.0.0.1
    # DB_PORT=3306
    # DB_DATABASE=your_database_name
    # DB_USERNAME=your_database_username
    # DB_PASSWORD=your_database_password
    ```

2. **Authentication**

    This project uses Laravel Breeze for authentication. You can customize the authentication settings in `config/auth.php` if needed.

## Usage

1. **Access the Application**


    Open your browser and go to [http://localhost:8000](http://localhost:8000). (ports may different)

2. **Navigation**

  Default Admin dummy:
  email: dummyadmin@example.com
  password: 123456

  Default Pegawai/User dummy:
  email: dummypegawai@example.com
  password: 123456

    - **Menu/Cashier**: View the menu and manage orders.
    - **Dashboard**: Overview of the application.
    - **Manage Items**: Add, edit, and delete menu items (admin only).
    - **Manage Users/Accounts**: View and manage user accounts (admin only).
    - **Transaction History**: View the history of transactions.
