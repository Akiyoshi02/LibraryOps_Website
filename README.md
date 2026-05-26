# 📚 LibraryOps — Online Bookstore & Library Operations System

**Version 0.1.0 — PHP/MySQL bookstore, customer ordering, and admin management**

LibraryOps is a full-stack PHP web application for browsing, searching, ordering, and managing books. The project includes a customer-facing storefront with account registration, cart, checkout, order history, product search, category browsing, and book detail pages, plus an admin panel for managing products, orders, users, and store activity.

The application is built with **PHP**, **MySQL**, **HTML**, **CSS**, and **JavaScript**, with a ready-to-import SQL database dump and bundled book cover assets for a complete local setup.

[![Repository](https://img.shields.io/badge/GitHub-Repository-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/Akiyoshi02/LibraryOps_Website)

---

## 🧭 Site Overview

- Customer storefront for browsing promoted books, full catalog pages, categories, and single-book details
- Account flow with registration, login, profile access, password change, and customer order history
- Shopping cart and checkout workflow with session-backed cart quantities and order placement
- Admin dashboard with summary counts for users, products, and orders
- Admin CRUD workflows for products, product images, orders, and users
- MySQL database schema and seed data included in `Database/php_project.sql`
- Responsive custom CSS styling with Font Awesome icons and local image assets

---

## 🧩 Feature Summary

| Category | Description |
|----------|-------------|
| 🖥️ **Frontend** | PHP-rendered pages with custom CSS, responsive navigation, book cards, category filters, search, cart views, checkout forms, and customer account pages. |
| 🛒 **Storefront** | Home page, book catalog, offer products, product detail pages, category product listings, and keyword search. |
| 👤 **Customer Accounts** | User registration, sign-in, session-based authentication, account dashboard, password updates, and order history. |
| 🧾 **Orders** | Cart-to-checkout flow with order and order-item persistence in MySQL. |
| 🛠️ **Admin Panel** | Secure admin login, dashboard metrics, product management, image updates, order editing/deletion, and user listing. |
| 🗄️ **Database** | MySQL dump with `admins`, `users`, `products`, `orders`, and `order_items` tables plus seeded catalog/admin data. |
| 🎨 **Assets** | Local book cover images and site images included with the storefront. |

---

## 🛠️ Setup / Run

### Prerequisites

- **PHP 8+** with `mysqli` enabled
- **MySQL 8+** or MariaDB
- A local web server such as **XAMPP**, **WAMP**, **MAMP**, Laragon, or Apache/Nginx configured for PHP
- **Git**

### 1. Clone the repository

```bash
git clone https://github.com/Akiyoshi02/LibraryOps_Website.git
cd LibraryOps_Website
```

### 2. Import the database

Create a MySQL database named `php_project`, then import the provided SQL dump:

```bash
mysql -u root -p php_project < Database/php_project.sql
```

You can also import `Database/php_project.sql` through phpMyAdmin.

### 3. Configure the database connection

Update the credentials in `Site/server/connection.php` if your local MySQL setup does not use the default XAMPP-style values:

```php
mysqli_connect("localhost", "root", "", "php_project");
```

Do not commit real production credentials.

### 4. Start the web server

Place the project in your local server document root, or configure a virtual host that points to the project folder.

Common XAMPP example:

```text
C:\xampp\htdocs\LibraryOps_Website
```

Start Apache and MySQL, then open:

```text
http://localhost/LibraryOps_Website/Site/site.php
```

### 5. Admin panel

Open the admin login page:

```text
http://localhost/LibraryOps_Website/Site/admin/login.php
```

The SQL dump includes an admin account record. If you do not know the password, reset it through the database or create a new admin record with a PHP `password_hash()` value.

---

## 📂 Project Structure

```text
├── Database/
│   └── php_project.sql          # MySQL schema and seed data
└── Site/
    ├── admin/                   # Admin dashboard and management pages
    ├── Images/                  # Site images and book covers
    ├── layouts/                 # Shared storefront header/footer
    ├── server/                  # Database connection and server handlers
    ├── account.php              # Customer account and order history
    ├── cart.php                 # Session-backed cart
    ├── checkout.php             # Checkout form
    ├── shop_now.php             # Catalog and filtering
    ├── single_product.php       # Book detail page
    ├── site.php                 # Storefront home page
    └── style.css                # Main storefront styling
```

---

## 🌟 Core Workflows

| Workflow | Summary |
|----------|---------|
| **Browse books** | Customers can view promoted products, browse catalog pages, filter by category, and open individual book pages. |
| **Search catalog** | The storefront search form routes users to matching book results. |
| **Manage account** | Customers can register, sign in, update passwords, and review previous orders. |
| **Place orders** | Customers add books to the cart, proceed to checkout, and submit order details. |
| **Admin management** | Admin users can view dashboard totals and manage products, product images, users, and order status. |

---

## 📦 Dependencies & Tooling

### Core

| Tool / Package | Role |
|----------------|------|
| [PHP](https://www.php.net/) | Server-side application logic and page rendering |
| [MySQL](https://www.mysql.com/) | Relational database for users, products, orders, and admin records |
| [mysqli](https://www.php.net/manual/en/book.mysqli.php) | PHP database connectivity |
| [Font Awesome](https://fontawesome.com/) | Icons used across navigation, product, cart, and admin UI |
| HTML / CSS / JavaScript | Page structure, styling, and client-side interactions |

### Local services

- **Apache/Nginx/PHP built-in server** — local PHP hosting
- **phpMyAdmin** — optional database import and inspection
- **MySQL or MariaDB** — database engine

---

## 🔐 Security Notes

- Keep production database credentials out of source control.
- Replace default/local credentials before deploying outside a development machine.
- The included SQL dump is intended for local development and demonstration.
- Passwords are stored using PHP password hashing; keep that pattern for new admin and customer records.

---

## 📄 License & Usage

This repository contains a student/project bookstore application for LibraryOps. Code, screenshots, and assets are intended for this project repository; do not reuse branding or project-specific content without permission.

---

_Updated: 2026-05-26_
