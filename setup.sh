#!/bin/bash

# Function to print dashed border
print_border() {
    printf "%-80s\n" | tr ' ' '-'
}

# Function to print colored text
print_colored() {
    printf "\033[0;32m$1\033[0m"
}

# Step 0:  make it executable by running `chmod +x setup.sh` then `.\setup.sh` in your terminal on linux.
# and on window `Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope Process` then `.\setup.sh` in your terminal on Window.

# Define variables for host and port
default_host="localhost"
default_port="8000"

# Welcome message
echo -e "\n"
print_border
echo -e "             Welcome to the Laravel setup script by Gilles Momeni              \n"
print_border
echo -e "\n"

# Menu
echo "Please select an option:"
print_border
echo "1. Perform one-time development installation"
echo "2. Run Laravel server on custom host and port (for pm2)"
echo "3. Exit"
print_border

read -p "Enter your choice: " choice
echo -e "\n"

case $choice in
    1)
        # Step 2: Install dependencies and generate key
        if [ ! -d "vendor" ]; then
            echo -e "[step 1] Installing Laravel dependencies...\n"
            composer install
        else
            echo -e "[step 1] Vendor directory already exists. Skipping dependency installation.\n"
        fi

        if [ ! -f ".env" ]; then
            echo -e "[step 2.1] Creating .env file...\n"
            cp .env.example .env
            echo -e "[step 2.2] Generating application key...\n"
            php artisan key:generate
        else
            echo -e "[step 2] .env file already exists. Skipping key generation.\n"
        fi

        # Step 3: Update the static data in the database
        # Display migration status before running migrations
        echo -e "[step 3] Checking migration status...\n"
        php artisan migrate:status

        migrations_status=$(php artisan migrate:status --no-ansi)
        if [[ $migrations_status != *"No"* ]]; then
            echo -e "\e[32m[step 3.1]\e[0m Running migrations..."
            php artisan migrate
        else
            echo -e "\e[32m[step 3.1]\e[0m All migrations have already been executed. Skipping migration."
        fi

        # Check if any seed data exists
        echo -e "[step 4] Checking seed data status...\n"
        seed_data_status=$(php artisan db:seed --class=DatabaseSeeder --pretend)
        if [[ $seed_data_status != *"Nothing to seed"* ]]; then
            echo  "[step 4.1] Records already exist in migrations table. Skipping seeding."
            # Display user information in tabular format
            echo ""
            print_border
            echo -e "\e[32m               Default users created:                                           \e[0m"
            print_border
            printf "\e[32m| %-20s | %-20s | %-30s |\e[0m\n" "Name" "Email" "Role"
            print_border
            printf "| %-20s | %-20s | %-30s |\n" "ADMIN" "admin@admin" "Admin"
            printf "| %-20s | %-20s | %-30s |\n" "PRATICIENT" "doc@admin" "Praticien"
            print_border
            echo -e "\n"
        else
            echo -e "[step 4.1] No seed data available. Creating seed data...\n"
            php artisan db:seed
        fi

        # Step 4: Run the Laravel app
        echo -e "\n"
        print_border
        echo -e "           [step 5] Starting Laravel development server...                        \n"
        print_border
        echo -e "\n"
        php artisan serve --host=$default_host --port=$default_port
        ;;
    2)
        # Run Laravel server on custom host and port
        read -p "Enter the host (default: $default_host): " host
        host=${host:-$default_host}

        read -p "Enter the port (default: $default_port): " port
        port=${port:-$default_port}

        # Check if the port is already occupied
        while [[ $(lsof -i :$port) ]]; do
            echo "Port $port is already in use. Trying next port..."
            ((port++))
        done

        echo -e "\n"
        print_border
        echo -e "|               Running Laravel server on custom host and port...                |\n"
        print_border
        echo -e "\n"
        echo "Using host: $host"
        echo "Using port: $port"
        php artisan serve --host=$host --port=$port
        ;;
    3)
        echo -e "\n"
        print_border
        echo -e "|               Exiting...                                                       |\n"
        print_border
        echo -e "\n"
        exit 0
        ;;
    *)
        echo -e "\n"
        print_border
        echo -e "|               Invalid option. Exiting...                                        |\n"
        print_border
        echo -e "\n"
        exit 1
        ;;
esac
