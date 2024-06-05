# Local Installation with Manual Development Setup

> **You can know get the automatic installation script from [auto-installation-guide.md](./auto-installation-guide.md)**

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

```text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

- Replace "laravel" with the name of the database you created in step 3.
- If you have set a password for your MySQL database, enter it in the DB_PASSWORD field.
- Save the changes to the ".env" file.

## Step 2: Install dependencies and generate key

- Open a terminal or command prompt.
- Navigate to the Laravel app directory using the cd command. For example:

```text
cd C:/xampp/htdocs/gestion_des_soin
```

> jump this step and come back to it only if necessary.

- Run the following command to install Laravel dependencies:

```bash
composer install
```

- Once the dependencies are installed, run the following command to generate a unique application key:

```bash
php artisan key:generate
```

## Step 3: Update the static data in the database

- In the terminal or command prompt, navigate to the Laravel app directory if you're not already there.
- Migrate the tables up to the connected database bu running:

```bash
php artisan migrate
```

> To run a migration in Laravel without flushing the database (i.e., without dropping and recreating the tables), you can use the ` --pretend ` option

```bash
php artisan migrate --pretend
```

- Run the following command to update the seeder data in the database:

```bash
php artisan db:seed 
```

> add the flag "--class=ExampleSeeder" to update a specific seeder class data

## Step 4: Run the Laravel app

- In the terminal or command prompt, navigate to the Laravel app directory if you're not already there.
- Run the following command to start the Laravel development server:

```bash
php artisan serve
```

- The Laravel app should now be running. You can access it in your web browser at the following URL: <http://localhost/> or 127.0.0.1
- you can login on the admin pre-build account on "admin@admin" and password: "admin"

## Step 5: Deploy on local server

> let us consider you havea already install **pm2** you can do so using `npm i -g pm2` or `yarn add -g pm2`

- Give execution permission to the **laravel-pm2.sh** script by : ```chmod +x laravel-pm2.sh```

- lunch the command:

```bash
    pm2 start laravel-pm2.json
```

### Handle error

The error message you're seeing indicates that the PDO driver for PostgreSQL is not installed or not enabled in your PHP configuration. Here’s a step-by-step guide to resolve this issue:

> *follow this like to get comment error solution:* **See the [Error handler file](handleError.md) for more details.**
