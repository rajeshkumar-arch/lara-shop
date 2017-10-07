#### Laravel-Shop is a User Profiles, and Admin restricted user management and Products, shopping cart system.

####Prerequisites
1. PHP 7.*
2. Mysql 5.7
3. Composer
4. Node (Optional)

#### Installation Instructions
1. Create a MySQL database for the project
2. From the projects root run `cp .env.example .env`
3. Configure your `.env` file
4. Run `sudo composer update` from the projects root folder
5. From the projects root folder run `sudo chmod -R 755 ../laravel-shop`
6. From the projects root folder run `php artisan key:generate`
7. From the projects root folder run `php artisan migrate`
8. From the projects root folder run `composer dump-autoload`
9. From the projects root folder run `php artisan db:seed`
10. Now run the App

Rebuild Front End Assets with Mix (Laravel Mix)
11. From the projects root run `npm install` 
11. From the projects root run `npm run dev`  or `npm run production`

#### Login credentials : 

1. Admin Access: admin@admin.com/password
2. User Access: user@user.com/password


#### Key Features

1. Users Login, Register and Profile Management
2. Admin Users Management (CRUD)
3. Product store Management (CRUD)
4. Shopping cart for Guest and Users (CRUD)

#### Main Reference Repo:

1. User Profile Management: https://github.com/jeremykenedy/laravel-auth

Thanks