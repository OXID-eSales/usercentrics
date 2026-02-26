# OXID Cookie Management powered by usercentrics

[![Packagist](https://img.shields.io/packagist/v/oxid-professional-services/usercentrics.svg)](https://packagist.org/packages/oxid-professional-services/usercentrics)

This module provides the [Usercentrics](https://usercentrics.com/de/preise/?partnerid=16967#business-paket) functionality for the [OXID eShop](https://www.oxid-esales.com/) allowing you to use their Consent Management Platform.

## Branch Compatibility

* b-7.5.x branch and v3.3.0 for b-7.5.x shop compilation branches
* b-7.4.x branch and v3.2.1 for b-7.4.x shop compilation branches
* b-7.3.x branch and v3.1.0 for b-7.3.x shop compilation branches
* b-7.2.x branch and v3.0.0 for b-7.2.x shop compilation branches
* b-7.1.x branch and v3.0.0 for b-7.1.x shop compilation branches
* b-7.0.x branch and v3.0.0 for b-7.0.x shop compilation branches
* b-6.5.x branch for b-6.5.x shop compilation branches
* b-6.3.x branch for b-6.3.x and b-6.4.x shop compilation branches
* b-6.2.x branch for b-6.2.x shop compilation branches

## Installation

### Module installation via composer

In order to install the module via composer, run one of the following commands
on commandline in your shop base directory (where the shop's composer.json file resides).

* **composer require oxid-professional-services/usercentrics:^3.3.0** to install the released version compatible with OXID eShop 7.5.x compilations
* **composer require oxid-professional-services/usercentrics:^3.2.0** to install the released version compatible with OXID eShop 7.4.x compilations
* **composer require oxid-professional-services/usercentrics:^3.1.0** to install the released version compatible with OXID eShop 7.3.x compilations
* **composer require oxid-professional-services/usercentrics:^3.0.0** to install the released version compatible with OXID eShop 7.0.x - 7.2.x compilations

and [activate the module](https://docs.oxid-esales.com/developer/en/latest/development/modules_components_themes/module/installation_setup/setup.html).

### Development installation

We recommend developing the module as independent as possible. This means that the module for development should
be installed as a [root package](https://getcomposer.org/doc/04-schema.md#root-package), with its own strict dependencies if such are needed.

The next section shows how to install the module as a root package by using the OXID eShop SDK.

In case of different environment usage, please adjust by your own needs.

### Development installation on OXID eShop SDK

The installation instructions below are shown for the current [SDK](https://github.com/OXID-eSales/docker-eshop-sdk)
for shop 7.5. Make sure your system meets the requirements of the SDK.

0. Ensure all docker containers are down to avoid port conflicts

1. Clone the SDK for the new project
```shell
echo MyProject && git clone https://github.com/OXID-eSales/docker-eshop-sdk.git $_ && cd $_
```

2. Clone the repository to the source directory
```shell
git clone --recurse-submodules https://github.com/OXID-eSales/usercentrics.git --branch=b-7.5.x ./source
```

3. Run the recipe to setup the development environment, you can decide which shop edition to install. Omitting the flag installs EE.
```shell
./source/recipes/setup-development.sh
```

You should be able to access the shop with http://localhost.local and the admin panel with http://localhost.local/admin
(credentials: noreply@oxid-esales.com / admin)

## Testing
### Linting, syntax check, static analysis

```bash
$ composer update
$ composer static
```

### Unit/Integration/Acceptance tests

- Install this module in a running OXID eShop
- Reset the shop's database

```bash
$ bin/oe-console oe:database:reset --db-host=db-host --db-port=db-port --db-name=db-name --db-user=db-user --db-password=db-password --force
```

- Run all the tests

```bash
$ composer tests-all
```

- Or the desired suite

```bash
$ composer tests-unit
$ composer tests-integration
$ composer tests-codeception
```

## Contributing

You like to contribute? 🙌 AWESOME 🙌\
Go and check the [contribution guidelines](CONTRIBUTING.md)

## Bugs and Issues

If you experience any bugs or issues, please report them in the section **Module Usercentrics** of https://bugs.oxid-esales.com.

## Documentation

The module documentation can be found on our documentation platform: https://docs.oxid-esales.com/modules/usercentrics/de/latest/.

## License

OXID Module and Component License, see [LICENSE file](LICENSE).
