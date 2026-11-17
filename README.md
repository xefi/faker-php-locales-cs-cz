# Faker PHP — cs_CZ locale

Czech (`cs_CZ`) locale for [Faker PHP](https://github.com/xefi/faker-php).

## Installation

```bash
composer require --dev xefi/faker-php-locales-cs-cz
```

The service provider is discovered automatically through Composer.

## Usage

```php
use Xefi\Faker\Faker;

$faker = new Faker('cs_CZ');
```

Generators without a `cs_CZ` variant fall back to the default locale.

## Extensions

This package provides `cs_CZ` variants of the address, colors, company, financial, person, phone and text extensions.
On top of the standard generators, it adds:

| Method | Extension | Description |
| --- | --- | --- |
| `rodneCislo(?string $gender = null)` | Person | Birth number (`YYMMDD/XXXX`), divisible by 11, month + 50 for women |
| `lastName(?string $gender = null)` | Person | Last name in its masculine or feminine form; `name()` keeps both parts in agreement |
| `ico()` | Company | Company identification number (IČO) with modulo 11 check digit |
| `vat()` | Company | VAT number (DIČ, `CZ` + IČO) |

## Contributing

1. Fork the repository and create a branch from `main`.
2. Add an extension under `src/Extensions/` and register it in `FakerCsCzServiceProvider::boot()`.
3. Add a test under `tests/Unit/`.
4. Run the suite with `vendor/bin/phpunit` (or `docker compose run php vendor/bin/phpunit`).
5. Open a pull request against `main`.

## License

MIT
