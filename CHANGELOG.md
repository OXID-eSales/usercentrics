# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## not released

### Changed
- Admin area: open API documentation in new browser tab

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

[1.1.0]: https://github.com/OXID-eSales/usercentrics/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/OXID-eSales/usercentrics/commits/v1.0.0
