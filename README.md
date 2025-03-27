# obituary-platform


## Overview
The **Obituary Platform** is a simple PHP-based web application that allows users to add and view obituaries. The platform includes a MySQL database for storing obituary information and a front-end interface for user interaction.

## Features
- View recent obituaries
- Add new obituaries
- Secure database connection using MySQLi
- Structured file organization for easy maintenance

## Prerequisites
Ensure you have the following installed:
- PHP 8.0 or later
- MySQL or MariaDB
- Apache or any local PHP development server (e.g., XAMPP, WAMP)

## Installation
1. **Clone the repository**:
   ```sh
   git clone https://github.com/franc-19/obituary-platform
   .git
   cd obituary-platform
   ```

2. **Configure the database**:
   - Create a MySQL database named `obituary_platform`.
   - Import the `database.sql` file (if provided) or manually create the `obituaries` table:
     ```sql
     CREATE TABLE obituaries (
         id INT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(255) NOT NULL,
         birth_date DATE NOT NULL,
         death_date DATE NOT NULL,
         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );
     ```

3. **Configure database connection**:
   - Edit the `config/config.php` file with your database credentials:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'your_username');
     define('DB_PASSWORD', 'your_password');
     define('DB_NAME', 'obituary_platform');
     ```

4. **Start the PHP server**:
   ```sh
   php -S localhost:8000
   ```
   OR if serving from the `public/` directory:
   ```sh
   php -S localhost:8000 -t public
   ```

5. **Visit the application**:
   Open [http://localhost:8000](http://localhost:8000) in your web browser.

## File Structure
```
obituary-platform/
├── config/
│   ├── config.php  # Database credentials
│   ├── db.php      # Database connection script
├── public/
│   ├── css/
│   │   ├── style.css  # Stylesheet
│   ├── default.jpg  # Default image
├── views/
│   ├── create.php  # Form to add obituaries
│   ├── view.php    # View obituary details
├── index.php       # Main homepage
├── README.md       # Project documentation
```



