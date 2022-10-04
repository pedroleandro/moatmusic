<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About Moat Builders Developer Task

The challenge is to implement a music collection application. The aim is to verify skills in the following aspects: code pattern, code organization and software architecture experience.

## Technologies used

- [Framework PHP Laravel](https://laravel.com/)
- [Git](https://git-scm.com/)
- [Docker](https://www.docker.com/)
- [MySQL](https://www.mysql.com/)
- [Spatie Laravel-permission](https://spatie.be/docs/laravel-permission/v5/introduction)

## Project installation instructions

### Clone the repository

`https://github.com/pedroleandro/moatmusicapp.git`

### Go to project folder

`cd moatmusicapp/`

### Run docker

`docker-compose up -d`

### Access application container

`docker exec -it moatmusic-app /bin/bash`

### Run artisan command to generate project key

`php artisan key:generate`

### Install dependencies via composer

`composer install`

### Copy and paste the .env.example file renaming to .env only

`cp .env.example .env`

### Run the migrations

`php artisan migration:fresh`

### Go to the project page at

`http://localhost:5000`

## Code challenge
>  This is a challenge by [Moad Builders](https://moatbuilders.notion.site/)
