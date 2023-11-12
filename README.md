# AMS - Article Management System

AMS is a Laravel-based Article Management System that allows users to create, manage, and view articles.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP 7.3
- Laravel 8.7
- Composer (for PHP dependencies)
- Node.js and npm (for JavaScript dependencies)

## Getting Started

1. Clone the project repository:
   ```
   git clone https://github.com/abdalkreemnofal09565/AMS.git
2. Install PHP dependencies using Composer:

    ```
    composer install
3. Install JavaScript dependencies using npm:

    ```
    npm install
4. Build the frontend assets:
    ````
    npm run dev
5. Start the Laravel development server:
    ````
    php artisan serve
6. Create two databases:
    ````
    One for the project (e.g., "AMS")
    Another for unit testing (e.g., "testing")
7. Run database migrations and seed the project database:
    ````
    php artisan migrate --seed
8. Run database migrations for the testing database:
    ````
    php artisan migrate --database=testing
9. Run unit tests:
    ````
    php artisan test
## Queue System
For the job queue system, you should run the following command:


    
    php artisan queue:listen
This will ensure that background jobs, such as sending email notifications, are processed.



## License
This project is open-source and available under the MIT License.



