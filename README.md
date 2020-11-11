# Usercentrics module

## Development

### Installation

By being in your shop root directory (where main composer.json is):

```bash
$ git clone https://github.com/OXID-eSales/usercentrics.git source/modules/oxps/usercentrics
$ composer config repositories.oxid-professional-services/usercentrics path ./source/modules/oxps/usercentrics
$ composer require oxid-professional-services/usercentrics:*
$ vendor/bin/oe-console oe:module:install source/modules/oxps/usercentrics/
```

### Running tests

To run the tests, configure the module in test_config.yaml like:

```
...
partial_module_paths: oxps/usercentrics
...
run_tests_for_shop: false
run_tests_for_modules: true
...
```

Adjust the `Tests/Codeception/acceptance.suite.yml` with correct selenium server host:

```
- WebDriver:
    ...
    host: 'localhost'
    ...
```

Now it should be possible to run the tests:

```
$ vendor/bin/runtests
$ vendor/bin/runtests-codeception
```