# How to fix common errors?

working across this platform we initially did the app with MySql but we needed to sync it which the other applications of the sai i lama ecosystem so we decided to migrate the work from `MYSQL` to `POSTGRESQL`, Here are some common errors you could encounter:

- In the can when deploying the application on local you got the error:

```text
PS C:\Users\USER\workspace\gestion-des-soin-laravel> php artisan migrate

   Illuminate\Database\QueryException 

  could not find driver (SQL: select * from information_schema.tables where table_schema = public and table_name = migrations and table_type = 'BASE TABLE')

  at C:\Users\USER\workspace\gestion-des-soin-laravel\vendor\laravel\framework\src\Illuminate\Database\Connection.php:712
    708▕         // If an exception occurs when attempting to run a query, we'll format the error
    709▕         // message to include the bindings with SQL, which will make this exception a
    710▕         // lot more helpful to the developer instead of just the database's errors.
    711▕         catch (Exception $e) {
  ➜ 712▕             throw new QueryException(
    713▕                 $query, $this->prepareBindings($bindings), $e
    714▕             );
    715▕         }
    716▕     }

  1   C:\Users\USER\workspace\gestion-des-soin-laravel\vendor\laravel\framework\src\Illuminate\Database\Connectors\Connector.php:70
      PDOException::("could not find driver")

  2   C:\Users\USER\workspace\gestion-des-soin-laravel\vendor\laravel\framework\src\Illuminate\Database\Connectors\Connector.php:70
      PDO::__construct("pgsql:host=127.0.0.1;dbname='laravel';port=5432;sslmode=prefer", "postgres", "password", [])
```

This guide will help you set up PostgreSQL with Laravel and resolve the "could not find driver" error.

## Step 1: Enable the PDO_PGSQL Extension

### On Windows

1. **Locate the PHP Configuration File**:
   - Open `php.ini` (e.g., `C:\php\php.ini` or `C:\xampp\php\php.ini`).

2. **Enable the Extension**:
   - Uncomment the following lines by removing the semicolon (`;`):

     ```ini
     extension=pdo_pgsql
     extension=pgsql
     ```

3. **Restart the Web Server**:
   - Restart Apache or your web server via the control panel or command line.

### On Linux

1. **Install the Extension**:

```sh
   sudo apt-get install php-pgsql  # Debian-based systems
   sudo yum install php-pgsql      # Red Hat-based systems
```

2. **Restart the Web Server**:

```sh
    sudo systemctl restart apache2  # For Apache
    sudo systemctl restart nginx    # For Nginx
```

## Step 2: Verify the Installation

1. **Create a PHP Info File**:
   - Create a file named `info.php` in your web server’s root directory with the following content:

     ```php
     <?php phpinfo(); ?>
     ```

2. **Check the PHP Info Page**:
   - Navigate to `http://localhost/info.php` in your browser.
   - Look for the `pdo_pgsql` section to confirm the extension is enabled.
