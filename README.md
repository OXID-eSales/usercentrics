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