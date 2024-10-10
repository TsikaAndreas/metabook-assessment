# Metabook Assessment

## Overview

Metabook Assessment is a web application built using PHP, JavaScript, Vue.js, and other modern web technologies. This project aims to provide a platform for managing books and shelves with features like pagination, drag-and-drop book assignment, and more.

## Technologies Used

- **Backend**: PHP, Laravel
- **Frontend**: JavaScript, Vue.js
- **Package Managers**: npm, Composer
- **Database**: MySQL

## Prerequisites

- PHP 7.4 or higher
- Node.js and npm
- Composer
- MySQL
- Docker (optional, for development environment & **sail**)

## Installation

> **Note**: The following instructions are for setting up the project using **sail**. If you prefer to use a local development environment, you can set up the project without **sail** by following the instructions in the [Laravel documentation](https://laravel.com/docs/11.x/installation).

1. **Clone the repository**:
    ```sh
    git clone https://github.com/TsikaAndreas/metabook-assessment.git
    cd metabook-assessment
    ```

2. **Install PHP dependencies**:
    ```sh
    sail composer install
    ```

3. **Install JavaScript dependencies**:
    ```sh
    sail npm install
    ```
   > **Note**: If you are using a local development environment or has Node.js and npm installed, you can run `npm install` instead of `sail npm install`.
   
4. **Run database migrations**:
    ```sh
    php artisan migrate --seed
    ```

5. **Compile assets**:
    ```sh
    npm run build
    ```

## Usage

- **Access the application**: Open your browser and navigate to `http://localhost`.
- **Login**: The user authentication is Mocked by middleware, so you don't need to register or login.

## Features

- **Shelf Management**: Add, edit, and delete shelves.
- **Drag-and-Drop**: Assign books to shelves using drag-and-drop functionality.
- **Pagination**: Navigate through lists of books and shelves with pagination.
- **Error Handling**: User-friendly error messages and toasts.

## Author
This laravel application was developed by **Andrei-Robert Tsika**.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE.md) file for details.
