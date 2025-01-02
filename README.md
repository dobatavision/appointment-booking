# Laravel Appointment Booking System

This is a Laravel-based appointment booking system. Follow the instructions below to set up and start the project on a freshly installed Ubuntu 24.04 PC.

## Prerequisites

Before you begin, ensure you have the following installed on your system:

- PHP 8.0 or higher
- Composer
- MySQL
- Git

## Installation

### Step 1: Update and Upgrade the System

```bash
sudo apt update
sudo apt upgrade
```

### Step 2: Install PHP and Required Extensions

```bash
sudo apt install php php-cli php-mbstring php-xml php-curl php-zip php-mysql php-gd php-bcmath php-json php-tokenizer php-pear php-dev
```

### Step 3: Install Composer

```bash
sudo apt install composer
```

### Step 4: Install MySQL

```bash
sudo apt install mysql-server
```


### Step 5: Create a MySQL Database and User

```bash
sudo mysql -u root -p
```

Inside the MySQL shell, run the following commands:

```sql
CREATE DATABASE appointment_booking;
CREATE USER 'appointment_user'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON appointment_booking.* TO 'appointment_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### Step 6: Clone the Repository

```bash
git clone https://github.com/dobatavision/appointment-booking.git
cd appointment-booking
```

### Step 7: Install Dependencies

```bash
composer install
```

### Step 8: Set Up Environment Variables

Copy the `.env.example` file to `.env`:

```bash
cp 

.env.example

 .env
```

Update the `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=appointment_booking
DB_USERNAME=appointment_user
DB_PASSWORD=your_password
```

### Step 9: Generate Application Key

```bash
php artisan key:generate
```

### Step 10: Run Migrations and Seeders

```bash
php artisan migrate --seed
```

### Step 11: Serve the Application

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser to see the application.

## Additional Commands

### Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear

php artisan config:cache
php artisan route:cache
```
