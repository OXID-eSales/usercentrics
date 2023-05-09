# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.2] - 2023-05-09

### Fixed
- Fix version in metadata
- Fix version links in the changelog

## [2.0.1] - 2023-05-05

### Changed
- License updated - OXID Module and Component License instead of GPL
- Readme updated to clarify shop version compatibility

## [2.0.0] - 2023-05-04

### Added
- Supports Twig shop configuration
- Github workflow with tests runs added
- PHP 8.0 and 8.1 support

### Changed
- Not autowired container access goes through the `OxidProfessionalServices\Usercentrics\Traits\ServiceContainer` trait
- `OxidProfessionalServices\Usercentrics\Service\ModuleSettings` improved:
  - Every module setting have its own getter
  - New module settings service used to access module configurations
- Tests are not based on testing library anymore

### Fixed
- Templates extracted from `src` directory and moved one level up

### Removed
- Php 7.x are not supported anymore

## [1.2.1] - 2022-06-07

### Fixed
- `OxidProfessionalServices\Usercentrics\Service\Integration\IntegrationScriptBuilder` constructor's type-hint

## [1.2.0] - 2021-11-03

### Added
- Add [deactivateBlocking configuration](https://docs.usercentrics.com/#/smart-data-protector?id=deactivate-smart-data-protector-for-specific-services) feature
- Development related hidden parameter developmentAutomaticConsent

### Fixed
- Rework tests to work with UserCentrics CMPv2
- Possibility to run tests with new chrome browser
- Fix possible test runner environment constants names to fit testing library documentation 

## [1.1.3] - 2021-04-12

### Fixed
- Fixed tests for never phpunit versions

## [1.1.2] - 2021-03-10

### Changed
- Admin area: the link with the partnerid that is showed points directly to price and order form from usercentrics

## [1.1.1] - 2021-03-03

### Changed
- Admin area: open API documentation in new browser tab
- Admin area: added registration link

### Fixed
- Fix default value for usercentricsMode
- Improved the tests to be more stable on different shop modules configurations

## [1.1.0] - 2021-01-19

### Added
- Support for Usercentrics CmpV2 including legacy browser mode.
- Support for Usercentrics CmpV2 TFC (experimental).
- ``Service\ModuleSettings`` class for accessing this module settings.

### Deprecated
- ``Core\ViewConfig::getUsercentricsID``

### Changed
- ``ModuleSettingsInterface`` is used to access module settings in the shop.

### Fixed
- Tests improved and cleaned up.
- Added tests for several edge cases.

## [1.0.0] - 2020-12-09

### Added
- Module provides a possibility to turn on "Smart data protection" function provided by UserCentrics.
- Possibility to configure any javascript included with oxscript tag to usercentrics service, and allow client to manipulate (turn it on/off) by Usercentrics data protection panel.

[2.0.2]: https://github.com/OXID-eSales/usercentrics/compare/v2.0.1...v2.0.2
[2.0.1]: https://github.com/OXID-eSales/usercentrics/compare/v2.0.0...v2.0.1
[2.0.0]: https://github.com/OXID-eSales/usercentrics/compare/v1.2.1...v2.0.0
[1.2.1]: https://github.com/OXID-eSales/usercentrics/compare/v1.2.0...v1.2.1
[1.2.0]: https://github.com/OXID-eSales/usercentrics/compare/v1.1.3...v1.2.0
[1.1.3]: https://github.com/OXID-eSales/usercentrics/compare/v1.1.2...v1.1.3
[1.1.2]: https://github.com/OXID-eSales/usercentrics/compare/v1.1.1...v1.1.2
[1.1.1]: https://github.com/OXID-eSales/usercentrics/compare/v1.1.0...v1.1.1
[1.1.0]: https://github.com/OXID-eSales/usercentrics/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/OXID-eSales/usercentrics/commits/v1.0.0
