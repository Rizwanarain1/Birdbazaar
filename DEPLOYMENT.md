# AviNest - Enterprise Production Deployment Guide 🚀

This manual provides a step-by-step procedure for hosting the **AviNest** Web Application live on any cPanel, Hostinger, VPS, or cloud web hosting provider.

---

## 📋 Requirements & Prerequisites

- **PHP Version:** PHP 8.0 or higher
- **PHP Extensions:** `pdo_mysql`, `gd`, `fileinfo`, `json`, `session`
- **Database:** MySQL 5.7+ or MariaDB 10.3+
- **Web Server:** Apache (with `mod_rewrite` enabled) or Nginx

---

## 🛠️ Step-by-Step Live Deployment Instructions

### Step 1: Upload Project Files
1. Compress all files in your project directory into a `.zip` archive.
2. Log in to your Web Hosting **cPanel** or **File Manager**.
3. Navigate to the web root folder (usually `public_html/` for primary domain or `subdomain.domain.com/`).
4. Upload the `.zip` archive and extract all contents.

---

### Step 2: Set Up MySQL Database
1. In cPanel, open **MySQL Database Wizard**.
2. Create a new database named `avinest_db` (or hosting prefix e.g., `user_avinest`).
3. Create a database user with a strong password and assign **ALL PRIVILEGES** to the database.
4. Open **phpMyAdmin** from cPanel.
5. Select your new database, click **Import**, select `database.sql` from your project files, and click **Go**.

---

### Step 3: Update Database Credentials
Open `config/db.php` on your server and update the connection credentials:

```php
private static $host = "localhost";
private static $db_name = "your_cpanel_dbname";
private static $username = "your_cpanel_dbuser";
private static $password = "your_strong_password";
```

---

### Step 4: Configure Directory Permissions
Ensure write permissions are set on storage directories:
- `uploads/` -> **`755`** or **`777`**
- `logs/` -> **`755`** or **`777`**

---

### Step 5: Enable Production Mode
Open `config/env.php` and set environment to production:

```php
define('APP_ENV', 'production');
```
This hides raw PHP error messages from visitors and logs errors securely to `logs/error.log`.

---

## 🔒 Security Checklist
- [x] Password hashing with `password_hash()` and `password_verify()`.
- [x] PDO prepared statements against SQL injection.
- [x] Server-side file validation (max 5MB, JPG/PNG/WebP).
- [x] `.htaccess` blocking direct web access to `config/` and `logs/`.
- [x] HTTP Security Response Headers (`X-Frame-Options`, `X-XSS-Protection`, `X-Content-Type-Options`).

---

## 🎉 Congratulations!
Your **AviNest** web application is now live, secure, and ready for production users!
