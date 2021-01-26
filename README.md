<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Installation

- install composer of project: "composer install"
- install passport package for auth api: "composer install":
    "php artisan passport:install"
    "php artisan passport:client --personal" -> "vapulus"
- install migration of database project: "php artisan migrate"
- run faker to make fill data into database: "php artisan db:seed"

## Coding

- all business logic in "UserController.php", "RoomController.php", "MessageController.php" class.
- all api in "api.php" file.
- all models class in "User.php", "Room.php", "Message.php".

## API Document:

- Postman: https://documenter.getpostman.com/view/8316268/TW6uqpZw
- Swagger: http://localhost/interview/vapulus/api/documentation

## Swagger ScreenShot

<p align="center">
<img src="./resources/img/swagger.png" style="height: 300px;" >
</p>

## Database Schema

<p align="center">
<img src="./resources/img/qnlfa.png" style="height: 300px;" >
</p>


## Tools

- Programming Language: PHP 7.2
- Framework: Laravel 8.04
- Database: MySQL

## Packages

- Passport Package
- Swagger Package
