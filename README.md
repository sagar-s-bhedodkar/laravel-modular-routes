# 🧱 Laravel Modular Routes

> **Easily manage modular routes in Laravel projects — automatically generate, organize, and load module routes and controllers.
Keep your application clean, scalable, and production-ready with minimal setup.
Each module can have its own routes, controllers, views, and tests, making large applications easier to maintain.
Automatically detects and registers module routes without manual imports, saving development time.
Ideal for teams, enterprise projects, and developers who want a professional, modular Laravel architecture.**

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)
[![Laravel](https://img.shields.io/badge/Laravel-10.x%20|%2011.x%20|%2012.x-red.svg)](https://laravel.com)
[![Packagist](https://img.shields.io/packagist/v/sagar-s-bhedodkar/laravel-modular-routes.svg)](https://packagist.org/packages/sagar-s-bhedodkar/laravel-modular-routes)
[![GitHub stars](https://img.shields.io/github/stars/sagar-s-bhedodkar/laravel-modular-routes.svg)](https://github.com/sagar-s-bhedodkar/laravel-modular-routes/stargazers)

---

## 📘 Table of Contents

* [Introduction](#-introduction)
* [Features](#-features)
* [Installation](#-installation)
* [Usage](#-usage)
* [Example Workflow](#-example-workflow)
* [Contributing](#-contributing)
* [License](#-license)
* [Author](#-author)

---

## 🚀 Introduction

**Laravel Modular Routes** is a lightweight package for **modular route management**.
It allows developers to automatically create modules with controllers and route files and load them dynamically, keeping your application organized and production-ready.

Create a module in seconds:

```bash
php artisan make:module Customer
```

The routes and controllers are automatically generated and ready for use.

---

## ✨ Features

* 🧩 Automatic module scaffolding
* 📂 Supports API and Web routes per module
* 🔄 Dynamic autoloading of module classes (no composer.json edits required)
* ⚙️ Artisan commands for module management:

  * `make:module` — Create a new module with CRUD routes
  * `module:list` — List all modules
  * `module:clear-cache` — Clear module cache
* 🧹 Clean folder structure (`Modules/ModuleName/`)
* ✅ Production-ready, scalable approach for large applications

---

## ⚙️ Installation

Require the package via Composer:

```bash
composer require sagar-s-bhedodkar/laravel-modular-routes:@dev
```

The package auto-discovers itself; no manual registration is required.

---

## 🧠 Usage

### ➕ Create a module

```bash
php artisan make:module Customer
```

This generates:

```
Modules/
 └── Customer/
     ├── Routes/api.php
     └── Http/Controllers/CustomerController.php
```

### 📝 Access routes

For example, if your module is `Customer`:

* GET `/api/customer` → List all customers
* POST `/api/customer` → Create a new customer
* GET `/api/customer/{id}` → Show customer
* PUT `/api/customer/{id}` → Update customer
* DELETE `/api/customer/{id}` → Delete customer

### 🔄 List modules

```bash
php artisan module:list
```

### 🧹 Clear module cache

```bash
php artisan module:clear-cache
```

---

## 🧩 Example Workflow

1. Run `php artisan make:module Customer`
2. Add business logic to `CustomerController`
3. Routes are automatically available under `/api/customer`
4. Add more modules similarly without touching core routes

---

## 🤝 Contributing

Contributions are welcome!

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/new-feature`
3. Commit your changes: `git commit -m "Add new feature"`
4. Push to your fork: `git push origin feature/new-feature`
5. Submit a Pull Request 🎉

---

## 📄 License

This package is open-sourced software licensed under the **MIT license**.

---

## 👨‍💻 Author

**Sagar Sunil Bhedodkar**
📧 [sagarbhedodkar456@gmail.com](mailto:sagarbhedodkar456@gmail.com)
🌐 [GitHub Profile](https://github.com/sagar-s-bhedodkar)

---

> Made with ❤️ for Laravel developers who value modularity, automation, and production-ready code.
