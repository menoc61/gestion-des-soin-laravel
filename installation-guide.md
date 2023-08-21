# Local Installation with Manual Development Setup

## Table of Contents
0. [Configure database](#step-0-configure-database)
1. [Configure the Laravel app](#step-1-configure-the-laravel-app)
2. [Install dependencies and generate key](#step-2-install-dependencies-and-generate-key)
3. [Update the static data in the database](#step-3-update-the-static-data-in-the-database)
4. [Run the Laravel app](#step-4-run-the-laravel-app)

## Step 0: Configure database

- Choose a MySQL database local server like "Laragon" or "XAMPP". You can download from [Laragon](https://laragon.org/download/) and from [XAMPP](https://www.apachefriends.org/download.html).
- Make sure your MySQL server is up and running.

## step 1: Configure the Laravel app

- Open the Laravel app folder that you copied into the "htdocs" directory.
- Rename the ".env.example" file to ".env".
- Open the ".env" file with a text editor.
- Configure the database connection by modifying the following lines:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_de_soin
DB_USERNAME=root
DB_PASSWORD=
```
- Replace "gestion_de_soin" with the name of the database you created in step 3.
- If you have set a password for your MySQL database, enter it in the DB_PASSWORD field.
- Save the changes to the ".env" file.

## Step 2: Install dependencies and generate key

- Open a terminal or command prompt.
- Navigate to the Laravel app directory using the cd command. For example:
```
cd C:/xampp/htdocs/soin_v1
```
> jump this step and come back to it only if necessary.
- Run the following command to install Laravel dependencies:
```
composer install
```
- Once the dependencies are installed, run the following command to generate a unique application key:
```
php artisan key:generate
```
## Step 3: Update the static data in the database

- In the terminal or command prompt, navigate to the Laravel app directory if you're not already there.
- Migrate the tables up to the connected database bu running: 
```
php artisan migrate
```
- Run the following command to update the seeder data in the database:
```
php artisan db:seed 
```
> add the flag "--class=ExampleSeeder" to update a specific seeder class data
## Step 4: Run the Laravel app
- In the terminal or command prompt, navigate to the Laravel app directory if you're not already there.
- Run the following command to start the Laravel development server:
```
php artisan serve
```
- The Laravel app should now be running. You can access it in your web browser at the following URL: http://localhost/ or 127.0.0.1
- you can login on the admin pre-build account on "admin@admin" and password: "admin"
