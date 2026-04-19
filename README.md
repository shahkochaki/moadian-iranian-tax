<div align="center">

# Laravel Moadian - Iranian Tax Authority API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/shahkochaki/moadian-iranian-tax.svg?style=flat-square)](https://packagist.org/packages/shahkochaki/moadian-iranian-tax)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue?style=flat-square)](https://php.net)
[![Laravel Version](https://img.shields.io/badge/Laravel-8%2B-red?style=flat-square)](https://laravel.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)

A professional Laravel package for seamless integration with the **Iranian Tax Authority (سامانه مودیان)** API.
Handles authentication, digital signing, encryption, invoice submission, and inquiry all out of the box.

</div>

---

## Features

- Send invoices to the Moadian system with full JWS/JWE signing and encryption
- Inquiry by UID or reference number
- Get fiscal info and registration code information
- Automatic token management with nonce
- Supports encrypted private keys (password-protected .pem files)
- Laravel Facade support for clean, expressive syntax
- Laravel auto-discovery (no manual provider registration)

---

## Requirements

| Dependency  | Version                             |
| ----------- | ----------------------------------- |
| PHP         | `^7.4` or `^8.0`                    |
| Laravel     | `^8.0`, `^9.0`, `^10.0`, or `^11.0` |
| ext-openssl | \*                                  |

---

## Installation

Install via Composer:

```bash
composer require shahkochaki/moadian-iranian-tax
```

The service provider and facade are registered automatically via Laravel package auto-discovery.

### Publish the config file

```bash
php artisan vendor:publish --provider="Shahkochaki\Moadian\MoadianServiceProvider" --tag=config
```

---

## Configuration

Add the following variables to your `.env` file:

```dotenv
MOADIAN_USERNAME=your-username-here

# Path to your private key file (default: storage/app/keys/private.pem)
MOADIAN_PRIVATE_KEY_PATH=/path/to/private.pem

# Optional: password for encrypted private key
MOADIAN_PRIVATE_KEY_PASSWORD=your-private-key-password

# Path to your certificate file (default: storage/app/keys/certificate.crt)
MOADIAN_CERTIFICATE_PATH=/path/to/certificate.crt

# Optional: override the API base URL
MOADIAN_BASE_URI=https://tp.tax.gov.ir/requestsmanager/api/v2/
```

> **Default key locations:**
>
> - Private key: `storage_path('app/keys/private.pem')`
> - Certificate: `storage_path('app/keys/certificate.crt')`

---

## Usage

Use the `Moadian` facade anywhere in your application:

```php
use Shahkochaki\Moadian\Facades\Moadian;
```

### Get Server Info

```php
$
esponse = Moadian::getServerInfo();

if ($
esponse->isSuccessful()) {
    $data = $
esponse->getBody();
}
```

### Get Fiscal Info

```php
$
esponse = Moadian::getFiscalInfo();
```

### Get Registration Code Information

```php
// 11 digits for legal entities, 14 digits for natural persons
$
esponse = Moadian::getRegistrationCodeInformation('12345678901');
```

### Inquiry by UID

```php
$
esponse = Moadian::inquiryByUid(
    uid: 'your-uid',
    start: '2023-05-14T00:00:00.000000000+03:30',
    end:   '2023-05-14T23:59:59.123456789+03:30'
);
```

### Inquiry by Reference Number

```php
$
esponse = Moadian::inquiryByReferenceNumbers('your-reference-number');
```
