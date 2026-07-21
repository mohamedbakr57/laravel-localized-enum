# Localized Enum for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mohamedbakr57/localized-enum.svg)](https://packagist.org/packages/mohamedbakr57/localized-enum)  
[![Tests](https://github.com/mohamedbakr57/localized-enum/actions/workflows/run-tests.yml/badge.svg)](https://github.com/mohamedbakr57/localized-enum/actions)  
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

**Localized Enum** is a simple, lightweight Laravel package that adds localized labels to native PHP enums using Laravel’s translation system.  
Perfect for multilingual applications and API responses with dynamic localization support.

---

## 📚 Table of Contents
- [Usage](#-usage)
  - [Basic Usage](#basic-usage)
  - [Custom Translation Key](#custom-translation-key)
  - [Fallback Default](#fallback-default)
  - [Locale from Request Header](#locale-from-request-header)
  - [Override Header Key](#override-header-key)
- [Features](#-features)
- [Installation](#-installation)
- [Example Translation File](#-example-translation-file)
- [Testing](#-testing)
- [Development](#-development)
- [License](#-license)
- [Credits](#-credits)

---
## 🧪 Usage

### Basic Usage

```php
TestStatus::Approved->label(); 
// Output: "Approved by Admin" (if translation exists)
```

### Custom Translation Key

```php
TestStatus::Approved->label('custom.status.approved');
// Output: value from that specific key
```

### Fallback Default

```php
TestStatus::Approved->label('missing.key', 'Approved fallback');
// Output: "Approved fallback" if translation not found
```

### Locale from Request Header

If you're building an API and send locale via headers:

```http
GET /api/user
X-Locale: ar
```

The trait will use the `X-Locale` value automatically.

> 📝 Default header key is `X-Locale`, but it can be overridden.

### Override Header Key

The default header is `X-Locale`. You can change it app-wide via config (after
publishing with `php artisan vendor:publish --tag="localized-enum-config"`):

```php
// config/localized-enum.php
return [
    'header_key' => env('LOCALIZED_ENUM_HEADER_KEY', 'Accept-Language'),
    'available_locales' => ['en', 'ar'], // optional whitelist; null trusts any header value
];
```

Or override the method on a specific enum for per-enum control:

```php
enum TestStatus: string
{
    use HasLabel;

    protected function getLocaleHeaderKey(): string
    {
        return 'Accept-Language';
    }
}
```

Or override `getLabelLocale()` entirely for full control.

---

## ✨ Features

- 🏷️ Adds `label()` method to native PHP Enums
- 🌐 Fully supports Laravel’s translation system
- 🧠 Smart fallback resolution (from multiple key patterns)
- 🧪 Works great in API responses
- 🔧 Easily override locale detection via request headers
- 🔄 Defaults to `config('app.locale')` if no locale is sent
- ⚡ Compatible with flat or nested translation files

---

## 📦 Installation

```bash
composer require mohamedbakr57/localized-enum
```

---


## 📌 Example Translation File

```php
// lang/en/enums.php
return [
    'TestStatus.Approved' => 'Approved by Admin',
    'TestStatus.Pending'  => 'Waiting',
    'TestStatus.Rejected' => 'Rejected',
];
```

Supports both:

- `enums.FQCN.CASE`
- `enums.Basename.CASE`
- `FQCN.CASE`
- `Basename.CASE`
- Or just: `'Approved' => 'Approved Label'` for flat key fallback

---

## ✅ Requirements

- PHP: ^8.1, ^8.2, ^8.3, ^8.4
- Laravel: ^10.0, ^11.0, ^12.0, ^13.0

---

## 🧪 Testing

```bash
composer test
composer test-coverage
```

Run Pint for formatting:

```bash
composer format
```

---

## 🧰 Development

```bash
git clone https://github.com/mohamedbakr57/localized-enum.git
cd localized-enum
composer install
composer test
```

---

## 📄 License

Licensed under [MIT License](LICENSE)

---

## 🙌 Credits

Built and maintained by [Mohamed Bakr](https://github.com/mohamedbakr57)  
Stars and PRs are welcome ⭐️
