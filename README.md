# server setup

### Install composer

```
composer update
```

### Copy .env.exmaple to .env

```
cp .env.example .env
```

### Generate application key

```
php artisan key:generate
```

### Database configuration

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=helps //database_name
DB_USERNAME=root
DB_PASSWORD=  //if u have password write here & remove comment
```

### Migrate database with seeder

```
php artisan migrate --seed
```

### Local api base url

```
http://127.0.0.1:8000/api
```

# FrontEnd setup

### go to frontend directory

```
npm i
```

```
npm run dev
```
