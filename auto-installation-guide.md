# Local Installation with Automatic Setup using `setup.sh`

## Table of Contents

0. [Prerequisites](#prerequisites)
1. [Usage](#usage)
2. [Features](#features)
3. [Script Overview](#script-overview)
    - [Step 1: Configure the Laravel app](#step-1-configure-the-laravel-app)
    - [Step 2: Update the static data in the database](#step-2-update-the-static-data-in-the-database)
    - [Step 3: Run the Laravel app](#step-3-run-the-laravel-app)
    - [Step 4: Exit](#step-4-exit)
4. [Customization](#customization)
5. [Contributing](#contributing)
6. [License](#license)
7. [Common Error](#common-error)

## Prerequisites

Before running the setup script, ensure you have the following dependencies installed:

- [Composer](https://getcomposer.org/) globally installed
- [PHP](https://www.php.net/) globally installed
- [Laravel](https://laravel.com/docs/8.x) globally installed
- MySQL or compatible database server installed and running

## Usage

1. Make the script executable:

    ```bash
    chmod +x setup.sh
    ```

2. Run the script:

    ```bash
    ./setup.sh
    ```

## Features

- Interactive menu for easy selection of setup options.
- Automatic installation of Laravel dependencies.
- Automatic generation of application key if `.env` file does not exist.
- Migration status check and execution if needed.
- Seed data status check and creation if needed.
- Customizable host and port for running the Laravel server.

## Script Overview

### Step 1: Configure the Laravel app

- Checks for existing `vendor` directory and installs dependencies if not found.
- Copies `.env.example` to `.env` and generates application key if `.env` file does not exist.

### Step 2: Update the static data in the database

- Checks migration status and runs migrations if needed.
- Checks seed data status and creates seed data if needed.

### Step 3: Run the Laravel app

- Starts the Laravel development server with default or custom host and port.

### Step 4: Exit

- Exits the script.

## Customization

- Modify the `default_host` and `default_port` variables in the script to set default host and port values.
- Adjust the script logic to fit specific project requirements.

## Contributing

Contributions are welcome! Feel free to submit issues or pull requests on the [github.com/menoc61/gestion-des-soin-laravel](https://github.com/menoc61/gestion-des-soin-laravel/).

## License

This script is open-source and available under the [MIT License](LICENSE).

## Common Error

See the [Error handler file](handleError.md) for more details.
