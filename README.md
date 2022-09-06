<h1 align="center">YII2 Console Seeding</h1>

INTRODUCTION
------------
Main base implementation database seeding

INSTALLATION
------------
### Clone repository
You can then clone this project repository using the following command in domain directory:
~~~
git clone git@github.com:sihoulette/yii2-seeding.git . 
~~~

### Install via Composer
If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project using the following command in project directory root:
~~~
composer install
~~~

CONFIGURATION
-------------

### Database
Edit the file `.env` with real data, for example:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

MIGRATIONS
-------------
Apply database migrations, using the following command in application directory root:
~~~
php yii migrate/up
~~~

SEEDERS
-------------
Apply all database seeders, using the following command in application directory root:
~~~
php yii db/seed
~~~

Apply one database seeder , using the following command in application directory root:
~~~
php yii db/seed user-table-seeder
~~~