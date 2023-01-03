# Quick Start - Outilio

### Step by step
Clone this Repository
```sh
git clone https://github.com/kindertheo/Outilio.git
```

Create the .env file
```sh
cd outilio/
cp .env .env
```

Change DB_DATABASE=laravel in .env file
```sh
DB_DATABASE=outilio_db
```

####Then create database in your phpmyadmin

Install project dependencies
```sh
composer install --ignore-platform-reqs
npm install
```

Generate the Laravel project key
```sh
php artisan key:generate
```

Create tables and setup default data
```sh
php artisan migrate --seed
```

Run project
```sh
php artisan serve
npm run watch
```

Access the project
[http://localhost:8080](http://localhost:8080)
