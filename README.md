
# Setup Project

1. composer install

2. copy and rename .env.example to .env

3. php artisan key:generate

4. adjust absolute path of DB_DATABASE=your_absolute_path\database\database.sqlite in .env

5. database.sql comited with data so you can just run : php artisan serve


### Migrate Database

php artisan migrate


### Seed Database

php artisan db:seed



### Create New User
you can create new user via : http://localhost:8000/register



