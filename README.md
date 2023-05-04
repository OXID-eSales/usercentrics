# OXID Cookie Management powered by usercentrics

[![Packagist](https://img.shields.io/packagist/v/oxid-professional-services/usercentrics.svg)](https://packagist.org/packages/oxid-professional-services/usercentrics)

This module provides the [Usercentrics](https://usercentrics.com/de/preise/?partnerid=16967#business-paket) functionality for the [OXID eShop](https://www.oxid-esales.com/) allowing you to use their Consent Management Platform.

## Usage

This assumes you have OXID eShop (at least the `v6.2.0` compilation) up and running.

### Install

The Usercentrics module is already included in the OXID eShop compilation.

Module can be installed manually, by using composer:
```bash
$ composer require oxid-professional-services/usercentrics
```

After requiring the module, you need to activate it, either via OXID eShop admin or CLI.

Navigate to oxideshop folder and execute the following: 
```bash
$ vendor/bin/oe-console oe:module:activate oxps_usercentrics
```

### How to use

Activate the module and enter your usercentrics ID in the module settings.

User documentation: [DE](https://docs.oxid-esales.com/modules/usercentrics/de/latest/)

## Branch Compatibility

* b-7.0.x branch for b-7.0.x shop compilation branches
* b-6.5.x branch for b-6.5.x shop compilation branches
* b-6.3.x branch for b-6.3.x and b-6.4.x shop compilation branches
* b-6.2.x branch for b-6.2.x shop compilation branches

## Developer installation

```bash
$ git clone --branch=b-7.0.x https://github.com/OXID-eSales/usercentrics.git source/modules/oxps/usercentrics
$ composer config repositories.oxid-professional-services/usercentrics path ./source/modules/oxps/usercentrics
$ composer require oxid-professional-services/usercentrics:*

$ vendor/bin/oe-console oe:module:activate oxps_usercentrics
```

## Testing

For instructions on running tests, please refer to current version github development workflow.

## Contributing

You like to contribute? 🙌 AWESOME 🙌\
Go and check the [contribution guidelines](CONTRIBUTING.md)

## Issues

To report issues with the module, please use the [OXID eShop bugtracking system](https://bugs.oxid-esales.com/) - module Usercentrics project.

## License

OXID Module and Component License, see [LICENSE file](LICENSE).
