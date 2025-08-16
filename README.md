# Workopia Project

Workopia is a full-featured web platform for job searching and posting vacancies, built on the Laravel framework. It provides a user-friendly interface for both job seekers and employers.

## Table of Contents

- [About the Project](#about-the-project)
- [Key Features](#key-features)
- [Technology Stack](#technology-stack)
- [Prerequisites](#prerequisites)
- [Installation and Setup](#installation-and-setup)
- [Database](#database)
- [Testing](#testing)

## About the Project

This application is a job board. Employers can register, publish, edit, and delete their job listings. Job seekers can browse the list of vacancies, use search and filters, and apply for positions that interest them.

## Key Features

- **Authentication and Authorization:** User registration and login.
- **Job Management:** CRUD (Create, Read, Update, Delete) for job listings.
- **Dashboard:** Employers have a personal dashboard to manage their listings.
- **Search and Filtering:** Ability to search for jobs by keywords and other parameters.
- **Job Applications:** Job seekers can submit their resumes for vacancies.
- **Bookmarking:** Ability to save interesting jobs for later viewing.
- **Responsive Design:** The interface displays correctly on various devices, thanks to Tailwind CSS.

## Technology Stack

### Backend
- **PHP 8.1+**
- **Laravel 11**
- **Eloquent ORM**

### Frontend
- **JavaScript**
- **Vite** — build tool
- **Tailwind CSS** — CSS framework
- **Blade** — Laravel's templating engine

### Database
- **SQLite** (for local development)
- **Laravel Migrations & Seeding**

### Tooling & Environment
- **Composer** — PHP dependency manager
- **NPM** — JavaScript dependency manager
- **PHPUnit** — testing framework

## Prerequisites

Before you begin, ensure you have the following installed on your machine:
- **PHP >= 8.1**
- **Composer**
- **Node.js and NPM**
- **PostgreSQL**

## Installation and Setup

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/workopia-laravel.git
    cd workopia-laravel
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install JavaScript dependencies:**
    ```bash
    npm install
    ```

4.  **Create the environment file:**
    Copy the `.env.example` file to `.env`.
    ```bash
    cp .env.example .env
    ```

5.  **Generate the application key:**
    ```bash
    php artisan key:generate
    ```

6.  **Configure the database:**
    - First, create a new database in your PostgreSQL instance (e.g., `workopia`).
    - Then, update your `.env` file with your PostgreSQL credentials. It should look something like this:
    ```env
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=workopia
    DB_USERNAME=your_postgres_user
    DB_PASSWORD=your_postgres_password
    ```

7.  **Run migrations and seeders** (see the next section).

8.  **Run the development server:**
    - **Laravel (backend):**
      ```bash
      php artisan serve
      ```
    - **Vite (frontend):**
      ```bash
      npm run dev
      ```

After these steps, the application will be available at `http://127.0.0.1:8000`.

## Database

### Migrations
To create all the necessary tables in the database, run the command:
```bash
php artisan migrate
```

### Seeding
To populate the database with test jobs and users, run the command:
```bash
php artisan db:seed
```

## Testing

To run the test suite and ensure all application components are working correctly, use the command:
```bash
php artisan test
```
