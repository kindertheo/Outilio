[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=kindertheo_Outilio&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=kindertheo_Outilio)

# Quick Start - Outilio

### Step by step
Clone this Repository
```sh
git clone https://github.com/kindertheo/Outilio.git
```

Create the .env file
```sh
cd outilio/
cp .env.example .env
```

Change DB_DATABASE in .env file
```sh
DB_DATABASE=outilio_db
```

Change APP_URL in .env file
```sh
APP_URL=http://localhost:8000
```

Add recaptcha secret and url in .env file
```sh
RECAPTCHA_URL="https://www.google.com/recaptcha/api/siteverify"
RECAPTCHA_SECRET_KEY=6Lfjf9YjAAAAAA4KiJ-ZhMRXu6o0vENT-4O0piBS
```

#### Then create database in your phpmyadmin

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
