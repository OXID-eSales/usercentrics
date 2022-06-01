# OXID Cookie Management powered by usercentrics

[![Packagist](https://img.shields.io/packagist/v/oxid-professional-services/usercentrics.svg)](https://packagist.org/packages/oxid-professional-services/usercentrics)

This module provides the [Usercentrics](https://usercentrics.com/de/preise/?partnerid=16967#business-paket) functionality for the [OXID eShop](https://www.oxid-esales.com/) allowing you to use their Consent Management Platform.

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

User documentation: [DE](https://docs.oxid-esales.com/modules/usercentrics/de/latest/)

## Branch Compatibility

* master branch for master shop compilation branches
* b-6.5.x branch for b-6.5.x shop compilation branches
* b-6.3.x branch for b-6.3.x and b-6.4.x shop compilation branches
* b-6.2.x branch for b-6.2.x shop compilation branches

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
$ SELENIUM_SERVER_IP=selenium BROWSER_NAME=chrome ./vendor/bin/runtests-codeception
```

## Contributing

You like to contribute? 🙌 AWESOME 🙌\
Go and check the [contribution guidelines](CONTRIBUTING.md)

## Issues

To report issues with the module, please use the [OXID eShop bugtracking system](https://bugs.oxid-esales.com/) - module Usercentrics project.

## License

GPLv3, see [LICENSE file](LICENSE).
