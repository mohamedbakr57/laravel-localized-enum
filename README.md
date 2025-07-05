# Localized Enum for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mohamedbakr57/localized-enum.svg)](https://packagist.org/packages/mohamedbakr57/localized-enum)
[![Tests](https://github.com/mohamedbakr57/localized-enum/actions/workflows/run-tests.yml/badge.svg)](https://github.com/mohamedbakr57/localized-enum/actions)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

**Localized Enum** is a simple and lightweight Laravel package that enhances native PHP enums with localized labels using Laravel’s translation system. Ideal for multilingual applications where you want human-readable enum values.

---

## 📚 Table of Contents
- [Usage](#-usage)
    - [Basic Usage](#basic-usage)
    - [With Custom Key](#with-custom-key-force-a-specific-key)
    - [With Fallback Default](#with-fallback-default)
    - [Without any key or translation](#without-any-key-or-translation)
- [Features](#-features)
- [Installation](#-installation)
- [Testing](#-testing)
- [Requirements](#-requirements)
- [Example Output](#-example-output)
- [Development](#-development)
- [License](#-license)
- [Credits](#-credits)

---
## 🧪 Usage

This package adds a `label()` method to your native PHP enums, which will try to resolve a translated string using Laravel’s Lang system. It attempts the following keys in order:

- `enums.{FQCN}.{name}`
- `enums.{ClassBasename}.{name}`
- `{FQCN}.{name}`
- `{ClassBasename}.{name}`

If no match is found, it falls back to a `Str::headline()` of the enum name (e.g., `'APPROVED'` → `'Approved'`).

### Basic Usage

```php
TestStatus::Approved->label(); // "Approved by Admin"
```

### With Custom Key (Force a specific key)

You can override the translation key directly:

```php
TestStatus::Approved->label('custom.status.approved');
```

### With Fallback Default

Optionally, provide a default string if translation fails:

```php
TestStatus::Approved->label('missing.key', 'Fallback Approved');
// Output: 'Fallback Approved'
```

### Without any key or translation

Fallbacks to a prettified enum name:

```php
TestStatus::Pending->label(); // "Pending"
```

---

## ✨ Features

- 🔤 Translates PHP enums into localized labels
- 🌐 Fully supports Laravel’s native translation system
- 🔄 Supports multiple fallback strategies
- 🔧 Clean, trait-based implementation
- 🔁 Locale switching supported out-of-the-box

---

## 📦 Installation

Require the package via Composer:

```bash
composer require mohamedbakr57/localized-enum
```

No service provider registration is needed for Laravel 10+.

---


## 🧪 Testing

To run the test suite:

```bash
composer test
```

With coverage:

```bash
composer test-coverage
```

---

## ✅ Requirements

- PHP ^8.1
- Laravel ^10.0 | ^11.0 | ^12.0

---

## 📌 Example Output

With this enum:

```php
enum PaymentStatus: string
{
        use HasLabel;

        case Paid = 'paid';
        case Pending = 'pending';
        case Failed = 'failed';
}
```

And this translation file (`lang/en/enums.php`):

```php
return [
        'PaymentStatus.Paid' => 'Payment Complete',
        'PaymentStatus.Pending' => 'Awaiting Payment',
        'PaymentStatus.Failed' => 'Payment Failed',
];
```

You get:

```php
PaymentStatus::Paid->label();    // "Payment Complete"
PaymentStatus::Pending->label(); // "Awaiting Payment"
PaymentStatus::Failed->label();  // "Payment Failed"
```

---

## 🧰 Development

Clone and work locally using Laravel Workbench:

```bash
git clone https://github.com/mohamedbakr57/localized-enum.git
cd localized-enum
composer install
```

Run tests:

```bash
composer format
composer test
```

---

## 📄 License

Licensed under the [MIT license](LICENSE).

---

## 🙌 Credits

Developed and maintained by [Mohamed Bakr](https://github.com/mohamedbakr57). Contributions and PRs are welcome.

