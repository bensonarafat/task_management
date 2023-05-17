## Task Management

## Technology
This project was built with Laravel PHP, MySQL for Database and JavaScript

## Installation
- Run the command `composer install`
- Run the command `php artisan key:generate`
- If `.env` file diesn't exist, run the command `cp .env.example .env`
- Run the command `php artisan migrate` 
- You will be also asked to create the database, type `y` or `yes` 
-  If the above didn't prompt on your termial then do this. In the `.env` Update the database name with the one you created, to allow connection to a database else skip this step.
-  Run seeder `php artisan db:seed` to seed your database with some data
- Run `php artisan serve` to start server 
- Open your brower to run which might be `http://127.0.0.1:8000`

Thank you
