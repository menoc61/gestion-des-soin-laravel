# Gestion des soin installation wizard for server deployment

Welcome to the GESTION_SOIN_V1 Documentation! This documentation provides information on how to install, configure, and use GESTION_SOIN_V1, a responsive patient management system built with PHP Laravel 8 framework and MySQL.

## Table of Contents

- [Getting Started](#getting-started)
- [License](#license)
- [Features](#features)
- [Installation](#installation)
- [Admin Panel](#admin-panel)
- [Upgrade](#upgrade)
- [FAQ](#faq)
- [Resources](#resources)
- [Issue](#issue)

## Getting Started

GESTION_SOIN_V1 is a complete solution for doctors to manage patient appointments, details, and billing. It offers a user-friendly interface and a range of features to handle patients efficiently. The system is highly customizable and easy to set up. The documentation provides step-by-step instructions for installation and configuration. If you need assistance, feel free to contact us at <gillemomeni@gmail.com>.

## License

GESTION_SOIN_V1 is available under two licenses:

- Regular License: ![License](https://img.shields.io/badge/license-Regular%20License-brightgreen)
  - Use, by you or one client, in a single end product which end users are not charged for.
- Extended License: ![License](https://img.shields.io/badge/license-Extended%20License-blue)
  - Use, by you or one client, in a single end product which end users can be charged for.

Please ensure you purchase the appropriate license based on your usage requirements. For more details, refer to Envato License Policy.

## Features

- Security: ![Shield](https://img.shields.io/badge/security-Totally%20secured-success)
  - Totally secured system (SQL injection, XSS, CSRF)
  - Built on powerful Laravel Framework that has been tried and tested by millions of developers.
  - Passwords are encrypted using Bcrypt and Argon2 to make sure your data is safe.

- Language: ![Shield](https://img.shields.io/badge/language-Laravel-red)

- Other:
  - Easy and simple interface to use
  - Fully responsive for any kind of device.
  - Direct access or invalid URL press stopped for each page
  - Easy appointment scheduling
  - Can see past or future appointments in the appointment page
  - Easily store prescription of particular patient for future use
  - Manage billing of particular patient
  - Can print prescription and invoice of particular patient
  - Create & manage patients and their medical information
  - Create & manage drugs
  - Create & manage prescriptions
  - Create & manage appointments
  - Create & manage diagnosis tests
  - Print prescriptions
  - Auto generate serial numbers for appointments
  - Manage doctor’s profile
  - Translated to 3 languages: English, Spanish, and French

## Installation

To install GESTION_SOIN_V1, follow the steps outlined below:

1. **Server Requirements:**
   - PHP >= 7.3
   - BCMath PHP Extension
   - Ctype PHP Extension
   - Fileinfo PHP extension
   - JSON PHP Extension
   - Mbstring PHP Extension
   - OpenSSL PHP Extension
   - PDO PHP Extension
   - Tokenizer PHP Extension
   - XML PHP Extension

2. **Creating a new database:**
   - Before installing, you will need to create a new database. If you already know how to do this or have already created one, skip to the next step. Please use an empty database. In most cases, you should be able to create a database from your cPanel.

3. **Uploading Files:**
   - On some operating systems, the dotfiles are hidden by default. Before starting to upload the files, please make sure your file explorer has the option to view hidden files turned on.
   - After creating a database, upload the contents of the "files" folder to your server's web root folder (e.g., public_html).

4. **Important:**
   - Make sure that you have the `.env` file in your folder.
   - Make sure that `.htaccess` file got copied properly from the download to your server.

5. **Installation Wizard:**
   - Go to your website address, then you'll see an installation wizard.
   - To open the installer, visit:
     - yourdomain.com/install OR
     - yourdomain.com/public/install

   - Now the installer will show up. The first screen will be the Welcome Screen.

   > Note: If you are not able to access the website by accessing yourdomain.com/install, but you are able to access it via yourdomain.com/index.php/install, this means that you probably don't have Apache mod_rewrite installed and enabled.

For detailed installation instructionsLet's continue with the remaining part of the installation instructions:

For detailed installation instructions, please refer to the [Installation Guide](installation-guide.md).

## Admin Panel

GESTION_SOIN_V1 comes with a powerful admin panel that allows you to manage various aspects of the system. To access the admin panel, follow these steps:

1. Open your web browser.
2. Enter your GESTION_SOIN_V1 website URL followed by "/admin" (e.g., `https://yourdomain.com/admin`).
3. You will be prompted to enter your admin username and password.
4. After successful login, you will have access to the admin panel.

## Upgrade

To upgrade an existing installation of GESTION_SOIN_V1, follow the steps outlined below:

1. Create a backup of your database and files.
2. Download the latest version of GESTION_SOIN_V1 from the [This repo](https://github.com/menoc61/gestion-des-soin-laravel).
3. Extract the downloaded zip file to your local machine.
4. Upload the extracted files to your server, replacing the existing files.

For detailed upgrade instructions, please refer to the [Upgrade Guide](installation-guide.md).

## FAQ

Please check the [FAQ](https://github.com/menoc61/gestion-des-soin-laravel/issues) page for frequently asked questions and their answers.

## Resources

Find helpful resources for GESTION_SOIN_v1 below:

- comming soon 😶 [Documentation](https://gilles-momeni.vercel.app/)

## Issue

- If you have any questions or need support, a project to develop please [contact us](gillemomeni@gmail.com).
- Report issues or bug on the issue tab [ISSUE](https://github.com/menoc61/gestion-des-soin-laravel/issues)
- See the [Error handler file](handleError.md) for more details.
