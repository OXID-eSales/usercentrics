# OXID Cookie Management powered by usercentrics

[![Packagist](https://img.shields.io/packagist/v/oxid-professional-services/usercentrics.svg)](https://packagist.org/packages/oxid-professional-services/usercentrics)

This module provides the [Usercentrics](https://usercentrics.com/) functionality for the [OXID eShop](https://www.oxid-esales.com/) allowing you to use their Consent Management Platform.

## Usage

This assumes you have OXID eShop (at least the `v6.2.0` compilation) up and running.

### Install

The Usercentrics module is already included in the OXID eShop `v6.2.4` compilation.

Module can be installed manually, by using composer:
```bash
$ composer require oxid-professional-services/usercentrics
$ vendor/bin/oe-console oe:module:install source/modules/oxps/usercentrics
```

After requiring the module, you need to activate it, either via OXID eShop admin or CLI.

Navigate to oxideshop folder and execute the following: 
```bash
$ vendor/bin/oe-console oe:module:activate oxps_usercentrics
```

### How to use

Activate the module and enter your usercentrics ID in the module settings.

## Developer installation

```bash
$ git clone https://github.com/OXID-eSales/usercentrics.git source/modules/oxps/usercentrics
$ composer config repositories.oxid-professional-services/usercentrics path ./source/modules/oxps/usercentrics
$ composer require oxid-professional-services/usercentrics:*

$ vendor/bin/oe-console oe:module:install source/modules/oxps/usercentrics
```

## Testing

Modify the `test_config.yml` configuration:

```
    ...
    partial_module_paths: oxps/usercentrics
    ...
    activate_all_modules: true
    run_tests_for_shop: false
    run_tests_for_modules: true
    ...
```

Then tests can be run like this:

```bash
$ ./vendor/bin/runtests
$ SELENIUM_SERVER_IP=localhost ./vendor/bin/runtests-codeception
```

## Contributing

You like to contribute? 🙌 AWESOME 🙌\
Go and check the [contribution guidelines](CONTRIBUTING.md)

## License

GPLv3, see [LICENSE file](LICENSE).
