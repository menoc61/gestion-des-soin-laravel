#!/bin/bash

# Step 0:  make it executable by running `chmod +x setup.sh` then `.\setup.sh` in your terminal on linux.
# and on window `Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope Process` then `.\setup.sh` in your terminal on Window.

# Function to print dashed border
print_border() {
    printf "%-80s\n" | tr ' ' '-'
}

# Function to print colored text
print_colored() {
    printf "\033[0;32m$1\033[0m"
}

# Function to get value from .env file
get_env_value() {
    grep -E "^$1=" .env | cut -d '=' -f2
}

# Function to initialize global variables
initialize_globals() {
    timestamp=$(date +"%Y%m%d%H%M%S")
    db_host=$(get_env_value "DB_HOST")
    db_username=$(get_env_value "DB_USERNAME")
    db_password=$(get_env_value "DB_PASSWORD")
    db_database=$(get_env_value "DB_DATABASE")
    backup_dir="BACKUP_DIR"
    default_host="localhost"
    default_port="8000"
    is_password_set=$( [[ -n "$db_password" ]] && echo "-p$db_password" )
}

# Function to confirm continuation
confirm_continue() {
    read -p "Do you want to continue? (yes/no): " choice
    if [ "$choice" == "yes" ] || [ "$choice" == "y" ];  then
        exec "$0" "$@"
    elif [ "$choice" == "no" ] || [ "$choice" == "n" ]; then
        echo "Exiting script..."
        exit 0
    else
        echo "Invalid choice. Exiting script..."
        exit 1
    fi
}
# Function to cleanup backups files
cleanup_backups() {
    num_backups=$(ls -1 "$backup_dir" | wc -l)
    if [ "$num_backups" -gt 5 ]; then
        echo "Cleaning up old backups..."
        ls -t "$backup_dir" | tail -n +"$((num_backups - 4))" | while read -r file; do
            echo "Removing $file"
            rm "$backup_dir/$file"
        done
        echo "Cleanup complete."
    else
        echo "There are not enough backups to perform cleanup. Minimum 6 backups are required."
    fi
}

# Welcome message
echo -e "\n"
print_border
echo -e "         $(print_colored 'Welcome to the Laravel setup script by Gilles Momeni')                  \n"
print_border
echo -e "\n"

# Menu
echo " $(print_colored '[Step 0]') Please select an option:"
print_border
echo "$(print_colored '[1]'). Perform one-time development installation"
echo "$(print_colored '[2]'). Run Laravel server on custom host and port (for pm2)"
echo "$(print_colored '[3]'). Create a full backup of the current database"
echo "$(print_colored '[4]'). Restore data from a backup to the current database"
echo "$(print_colored '[5]'). Cleanup old backups"
print_border

read -p "Enter your $(print_colored '[choice']): " choice
echo -e "\n"

case $choice in
    1)
        initialize_globals
        # Step 2: Install dependencies and generate key
        if [ ! -d "vendor" ]; then
            echo -e "$(print_colored '[Step 1]') Installing Laravel dependencies...\n"
            composer install
            echo -e "\n"
        else
            echo -e "$(print_colored '[Step 1]') Vendor directory already exists. Skipping dependency installation.\n"
        fi

        if [ ! -f ".env" ]; then
            echo -e "$(print_colored '[Step 2.1]') Creating .env file...\n"
            cp .env.example .env
            echo -e "\n"
            echo -e "$(print_colored '[Step 2.2]') Generating application key...\n"
            php artisan key:generate
            echo -e "\n"
        else
            echo -e "$(print_colored ' [Step 2] ') .env file already exists. Skipping key generation...\n"
        fi

        # Step 3: Update the static data in the database
        # Display migration status before running migrations
        echo -e "$(print_colored ' [Step 3]') Checking migration status...\n"
        php artisan migrate:status
        echo -e "\n"
        migrations_status=$(php artisan migrate:status --no-ansi)
        if [[ $migrations_status != *"No"* ]]; then
            echo -e "$(print_colored '[Step 3.1]') Running migrations...\n"
            php artisan migrate
            echo -e "\n"

            echo -e "$(print_colored '[Step 4]') Checking seed data status...\n"

            echo -e "$(print_colored '[Step 4.1] No seed data available. Creating seed data...') \n"
            php artisan db:seed
            echo -e "\n"
            # Check if the db:seed command executed successfully (exit code 0)
            if [ $? -eq 0 ]; then
                echo -e "$(print_colored '[Step 4.2] Seed data successfully created. Displaying user information... ') \n"
                # Display user information in tabular format
                echo ""
                print_border
                echo -e "$(print_colored '               Default users created:                                           ')"
                print_border
                printf "\e[32m| %-20s | %-20s | %-30s |\e[0m\n" "Name" "Email" "Role"
                print_border
                printf "| %-20s | %-20s | %-30s |\n" "ADMIN" "admin@admin" "Admin"
                printf "| %-20s | %-20s | %-30s |\n" "PRATICIENT" "doc@admin" "Praticien"
                print_border
                echo -e "\n"
            else
                echo "$(print_colored '[Step 4.2] Error: Failed to seed data...') \n"
            fi
        else
            echo -e "$(print_colored '[Step 3.1]') All migrations have already been executed. Skipping migration...\n"
            echo -e "$(print_colored '[Step 4.1] Seed data already exists.') \n"
        fi
        # Step 4: Run the Laravel app
        echo -e "\n"
        print_border
        echo -e "         $(print_colored '[Step 5]') Starting Laravel development server...                        \n"
        print_border
        echo -e "\n"
        php artisan serve --host=$default_host --port=$default_port
        ;;

    2)
        initialize_globals
        # Ask user for custom host and port
        read -p "Enter the $(print_colored '[Host]') (default: $default_host): " host
        host=${host:-$default_host}

        read -p "Enter the $(print_colored '[Port]') (default: $default_port): " port
        port=${port:-$default_port}

        # Check if the port is already occupied
        while [[ $(lsof -i :$port) ]]; do
            echo "$(print_colored '[Port]') $port is already in use. Trying next port..."
            ((port++))
        done

        echo -e "\n"
        print_border
        echo -e "|           $(print_colored '    Running Laravel server on: ')$host and $port              |\n"
        print_border
        echo -e "\n"
        php artisan serve --host=$host --port=$port
        ;;
    3)
        initialize_globals
        # Step 1: Create a full backup of the database
        if [ ! -d "$backup_dir" ]; then
            echo "Backup directory not found. Creating backup directory..."
            mkdir -p "$backup_dir"
            if [ $? -ne 0 ]; then
                echo "Failed to create backup directory: $backup_dir"
                exit 1
            fi
        fi

        backup_file="$backup_dir/$db_database-$timestamp.sql"

        echo -e "$(print_colored '[Step 1]') Creating full database backup...\n"
        mysqldump -h "$db_host" -u "$db_username" $is_password_set "$db_database" > "$backup_file"
        dump_exit_code=$?

        if [ $dump_exit_code -eq 0 ]; then
            echo -e "$(print_colored '[Success]') Backup created successfully: $backup_file\n"
            confirm_continue
        else
            echo -e "$(print_colored '[Error]') Failed to create backup. MySQL dump exited with code $dump_exit_code.\n"
            exit 1
        fi
        ;;

    4)
        echo -e "\n $(print_colored '===============-0000  VERY IMPORTANT 0000-===============') \n"
        echo -e "\n $(print_colored '====== ENSURE DATABASE MIGRATION HAS BEEN EXECUTED ======') \n"
        echo -e "\n $(print_colored '=========================================================') \n"

        initialize_globals
        # Step 1: List all backup files in the backup directory
        if [ ! -d "$backup_dir" ]; then
            echo "Backup directory not found."
            exit 1
        fi

        # List all backup files with index
        echo "Available backups in $backup_dir:"
        backup_files=("$backup_dir"/*)
        for i in "${!backup_files[@]}"; do
            echo "$i. ${backup_files[$i]}"
        done

        # Loop until a valid backup ID is provided
        while true; do
            # Ask user to select a backup
            read -p "Enter the ID of the backup you want to restore: " selected_id

            # Validate selected ID
            if ! [[ "$selected_id" =~ ^[0-9]+$ ]] || (( selected_id < 0 )) || (( selected_id >= ${#backup_files[@]} )); then
                echo "Error: Invalid backup ID. Please enter a valid ID."
            else
                break
            fi
        done

        selected_backup="${backup_files[selected_id]}"

        # Step 2: Check if migrations have been done
        migrations_status=$(php artisan migrate:status --no-ansi)
        if [[ $migrations_status == *"No"* ]]; then
            echo "Migrations have not been executed. Executing migrations first..."
            php artisan migrate || { echo "Error: Failed to execute migrations."; exit 1; }
        fi

        # Step 3: Restore data from backup
        echo -e "$(print_colored '[Step 3]') Restoring database from backup...\n"

        # Extract table names from the selected backup
        backup_tables=$(grep -E "^-- Table structure for table" "$selected_backup" | awk '{print $5}' | sed 's/`//g')

        # Loop through each table in the current database
        for table in $backup_tables; do
            # Get column names of the current table
            current_columns=$(mysql -h "$db_host" -u "$db_username" $is_password_set "$db_database" -e "SHOW COLUMNS FROM $table;" | awk '{print $1}' | tail -n +2)

            # Get column names of the backup table
            backup_columns=$(grep -E "^-- Table structure for table \`?$table" "$selected_backup" | grep -oP '^\s*`\K[^`]+')

            # Loop through each column in the current table
            for column in $current_columns; do
                # Check if the column exists in the backup table
                if echo "$backup_columns" | grep -q "^$column$"; then
                    echo "Restoring data for column '$column' in table '$table'..."
                    # Check if the table has a primary key
                    primary_key=$(mysql -h "$db_host" -u "$db_username" $is_password_set "$db_database" -e "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY';" | grep -oP 'Column_name: \K\w+')
                    if [ -n "$primary_key" ]; then
                        # Update existing rows
                        mysql -h "$db_host" -u "$db_username" $is_password_set "$db_database" -e "UPDATE $table SET $column = (SELECT $column FROM $selected_backup.$table WHERE $table.$primary_key = $selected_backup.$table.$primary_key);"
                    else
                        # Insert data from backup table to current table
                        mysql -h "$db_host" -u "$db_username" $is_password_set "$db_database" -e "INSERT INTO $table ($column) SELECT $column FROM $selected_backup.$table;"
                    fi
                else
                    echo "Column '$column' not found in the backup table. It will be empty."
                fi
            done
        done

        echo -e "$(print_colored '[Success]') Database restored successfully from $selected_backup\n"
        confirm_continue
        ;;
       5)
        cleanup_backups
        ;;
    *)
        confirm_continue
        ;;
esac
