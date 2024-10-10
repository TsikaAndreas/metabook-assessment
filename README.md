# Metabook Assessment

## Overview

This Laravel-based web application allows users to manage their virtual book collections by creating shelves and assigning books using drag-and-drop functionality. It includes features such as pagination, error handling, and a user-friendly interface for easy book organization.

## Technologies Used

- **Backend**: PHP, Laravel
- **Frontend**: Vue.js, Tailwind CSS, JavaScript
- **Package Managers**: npm, Composer
- **Database**: MySQL

## Prerequisites

**Required:**

- **Docker**: Recommended for a quick, containerized setup.
- **WSL 2 with Ubuntu**: For Windows users running Docker Desktop.

**Optional (for non-Docker setup):**

- **Composer 2**: PHP package management.
- **Node.js 20.x / npm 10.x**: For frontend dependencies.
- **MySQL**: Database server.
- **PHP 8.3**: Required for Laravel.
- **Apache/Nginx**: Web server for local hosting.

## Installation

> **Note**: These steps are optimized for a Docker environment with `Laravel Sail` using `WSL 2`. If you're using a different environment, refer to the [Laravel installation documentation](https://laravel.com/docs/11.x/installation).

1. **Clone the Repository**:

   ```sh
   git clone https://github.com/TsikaAndreas/metabook-assessment.git
   cd metabook-assessment
   ```

2. **Build Docker Environment**:
   ```sh
   docker run --rm \
   -u "$(id -u):$(id -g)" \
   -v $(pwd):/var/www/html \
   -w /var/www/html \
   laravelsail/php83-composer:latest \
   composer update laravel/sail
   ```
3. **Start Sail**:

   ```sh
   ./vendor/bin/sail up -d
   ```

4. **Install JavaScript dependencies**:
   ```sh
   sail npm install
   ```
   > **Tip**: If you're not using Sail and have Node.js installed locally, you can use `npm install`.
5. **Run Database Migrations and Seeding**:

   ```sh
   php artisan migrate --seed
   ```

6. **Compile Frontend Assets**:
   ```sh
   npm run build
   ```

## Usage

- **Access**: Navigate to `http://localhost` in your browser.
- **Authentication**: No registration or login required—authentication is mocked through middleware.

## Features

- **Shelf Management**: Create, edit, and delete virtual shelves.
- **Drag-and-Drop**: Easily assign books to shelves using intuitive drag-and-drop functionality.
- **Pagination**: View books and shelves in paginated lists for smooth navigation.
- **Error Handling**: Friendly error toasts ensure a smooth user experience.

## Running Unit Tests

To run the unit tests within the Docker environment, use the following command:

```sh
./vendor/bin/sail php artisan test
```

## Author

Developed by **Andrei-Robert Tsika**.

## License

This project is open-sourced under the MIT License. See the[LICENSE](LICENSE.md) file for more information.
