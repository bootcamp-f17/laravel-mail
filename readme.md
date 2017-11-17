# Laravel Mail Thing

A self-contained messaging system for use in other applications.

## Install Instructions

1. $ git clone https://github.com/bootcamp-f17/laravel-mail.git

2. cd into laravel-mail

3. $ composer install

4. Create owner, password and database in psql

5. $ touch .env

6. Paste in code from .env.example into .env

7. Update DB_CONNECTION, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD in .env

8. $ php artisan key:generate to give you an APP_KEY

9. $ php artisan migrate (may have to add '--seed' to the end of this if there is seed data)

10. $ php artisan serve

You're ready to go!