# 🧱 Laravel Dev Snapshot

> **Automate Laravel development environment snapshots and restores — database, storage, and environment configuration — all in one command.**

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)
[![Laravel](https://img.shields.io/badge/Laravel-9.x%20|%2010.x%20|%2011.x%20|%2012.x-red.svg)](https://laravel.com)
[![Packagist](https://img.shields.io/packagist/v/sagar-s-bhedodkar/laravel-dev-snapshot.svg)](https://packagist.org/packages/sagar-s-bhedodkar/laravel-dev-snapshot)
[![GitHub stars](https://img.shields.io/github/stars/sagar-s-bhedodkar/laravel-dev-snapshot.svg)](https://github.com/sagar-s-bhedodkar/laravel-dev-snapshot/stargazers)

---

## 📘 Table of Contents
- [Introduction](#-introduction)
- [Features](#-features)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [Example Workflow](#-example-workflow)
- [Safety](#-safety)
- [Contributing](#-contributing)
- [License](#-license)
- [Author](#-author)

---

## 🚀 Introduction

**Laravel Dev Snapshot** is a lightweight package that helps developers manage their **local environment snapshots** easily.

Instead of manually exporting your database, copying `.env`, or saving config files — do it all with a single command:

```bash
php artisan dev:snapshot
php artisan dev:restore snapshot_name
```

This helps reset your local environment safely, reproduce bugs, or sync data across developers in seconds.

---

## ✨ Features

- 📦 Create and restore full development snapshots
- 🧠 Includes database, storage, `.env`, and configuration files
- ⚙️ Works only in `local` or `testing` environments (for safety)
- 🪶 Simple Artisan commands (`dev:snapshot`, `dev:restore`)
- 💾 Optional compression to ZIP files
- 🧹 Clean and easy rollback system

---

## ⚙️ Installation

Require the package via Composer:

```bash
composer require sagar-s-bhedodkar/laravel-dev-snapshot --dev
```

---

## 🔧 Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="SagarSBhedodkar\LaravelDevSnapshot\Providers\DevSnapshotServiceProvider" --tag=config
```

The configuration will appear at `config/dev-snapshot.php`:

```php
return [
    'snapshot_path' => env('DEV_SNAPSHOT_PATH', 'snapshots'),
    'include_storage_paths' => ['storage/app/public'],
    'include_env' => true,
    'include_config_paths' => ['config/app.php'],
    'exclude_tables' => [],
    'compress' => true,
    'allowed_environments' => ['local', 'testing'],
];
```

---

## 🧠 Usage

### ➕ Create a snapshot
```bash
php artisan dev:snapshot
```

Optionally name your snapshot:
```bash
php artisan dev:snapshot --name=my-local-backup
```

### ♻️ Restore a snapshot
```bash
php artisan dev:restore snapshot-20251012-abc123
```

---

## 🧩 Example Workflow

1. You make large DB or storage changes.
2. Run:
   ```bash
   php artisan dev:snapshot --name=pre-test
   ```
3. After testing, restore the environment:
   ```bash
   php artisan dev:restore pre-test
   ```
4. Your DB, env, and storage are restored to that state instantly.

---

## 🛡️ Safety

> Snapshots and restores will only run in **local** or **testing** environments.

The package will refuse to execute in **production** to avoid data loss.

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

> Made with ❤️ for Laravel developers who value automation, safety, and simplicity.
