# oxid-professional-services/usercentrics

[![Build Status](https://flat.badgen.net/travis/OXID-eSales/usercentrics/?icon=travis&label=build&cache=300&scale=1.1)](https://travis-ci.com/OXID-eSales/usercentrics)
[![PHP Version](https://flat.badgen.net/packagist/php/OXID-eSales/usercentrics/?cache=300&scale=1.1)](https://github.com/oxid-esales/usercentrics)
[![Stable Version](https://flat.badgen.net/packagist/v/OXID-eSales/usercentrics/latest/?label=latest&cache=300&scale=1.1)](https://packagist.org/packages/oxid-esales/usercentrics)

This module provides the [Usercentrics](https://usercentrics.com/) functionality for the [OXID eShop](https://www.oxid-esales.com/) allowing you to use their Consent Management Platform.

## Usage

This assumes you have OXID eShop (at least the `v6.2.0` compilation) up and running.

### Install

The Usercentrics module is already included in the OXID eShop `v6.2.4`.

If you use an eShop version below >`v6.2.4` (for example `v6.2.0`), you can install the module with composer like that:
```bash
$ composer require oxid-professional-services/usercentrics
```

After requiring the module, you need to activate it, either via OXID eShop admin or CLI.

Navigate to oxideshop folder and execute the following: 
```bash
$ vendor/bin/oe-console oe:module:activate oxps/usercentrics

```

### How to use

Activate the module and enter your usercentrics ID in the module settings.

## Testing

### Linting, syntax check, static analysis and unit tests

```bash
$ composer test
```

### Integration/Acceptance tests

- install this module into a running OXID eShop
- change the `test_config.yml`
  - add `oxps/usercentrics` to the `partial_module_paths`
  - set `activate_all_modules` to `true`

```bash
$ ./vendor/bin/runtests
```

## Contributing

You like to contribute? 🙌 AWESOME 🙌\
Go and check the [contribution guidelines](CONTRIBUTING.md)

## License

GPLv3, see [LICENSE file](LICENSE).
