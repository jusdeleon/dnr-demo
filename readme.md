## Prerequisites

This guide assumes that you have these software installed on your machine:

- [Git](https://git-scm.com/downloads)
- [PHP 7+](http://php.net/downloads.php)
- [Composer](https://getcomposer.org/download)
- [MySQL 5.7+](https://www.mysql.com/downloads)


## Installation

Clone this repository, then cd to the project root directory and run the commands below:

- Install Composer dependencies by running `composer install`
- Create the app's environment file by running `cp .env.example .env`
- Set the application key by running `php artisan key:generate`
- Run `php artisan storage:link` to make the customers' pictures accessible from the web.

After successfully running these commands, create a database then populate these items in the `.env` file with the correct settings:

```
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

You can leave the other items as is.

Finally, run `php artisan migrate --seed` to migrate the database and seed the user roles.

To view the app in the browser, run `php artisan serve --port=8000`. Access it via `localhost:8000`. (If you decide to serve the app in another way, please make sure to set the `APP_URL` to the correct value. Failing to do so will result an error in rendering customer images)

If you experience any errors while deploying the app, send me a message at <jusmdeleon@gmail.com>.