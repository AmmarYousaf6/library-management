
## Library Management

Library management will allow users to register, login, logout and checkin /
checkout books of a library. The backend portion is built in Laravel 8.31 and consists of Restful endpoints for all the users actions and also contains unit tests for
registering and checking in/out books.



----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x/installation)

Clone the repository

    git clone https://github.com/AmmarYousaf6/library-management

Switch to the repo folder

    cd library-management

Install all the dependencies using composer and install NPM packages

    composer install && npm install

Make the required configuration changes in the .env file

    nano .env


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/AmmarYousaf6/library-management
    cd library-management
    composer install && npm install
    nano .env

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users, books and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**


Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:fresh --seed


## API Specification

> [Full API Spec](https://documenter.getpostman.com/view/1793528/Tz5i9LXr) can be found here

----------

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Test Case

Run the laravel development server

    php artisan serve

Run the test

    php artisan test  

Or

    ./vendor/bin/phpunit

----------

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api


Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Optional 	| Authorization    	| Bearer &lt;token&gt;      	|

Refer the [api specification](#api-specification) for more info.

----------

# Authentication

This applications uses Laravel/Sanctum to handle authentication. The token is passed with each request using the `Authorization` header with `Token` scheme. The Sanctum authentication middleware handles the validation and authentication of the token. Please check the following sources to learn more about Laravel/Sanctum.

- https://laravel.com/docs/8.x/sanctum
