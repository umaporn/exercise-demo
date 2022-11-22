# Interview Exercise

## How to initialize this project
1. After you finish cloning this project then you have to **create .env file from .env.example file 
   depending on your environment**. After that run the following commands below.
    - docker-compose up *-- To create laravel-app container.*
    - docker-compose exec laravel-app composer install *-- To install PHP components.*
    - docker-compose exec laravel-app php artisan key:generate *-- To create an application key to support cryptography.*
    - docker-compose exec laravel-app  php artisan migrate *-- To migrate the database. Reference: [Running Migrations]*
    - npm install *-- To install JavaScript components.*
    - docker-compose exec laravel-app php artisan test *-- To run unit test.*
