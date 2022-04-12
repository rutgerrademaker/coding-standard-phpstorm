# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 2.4.0 - 2022-04-13
### Added
- A project resolver to decide which project is installed. Also added a config to overwrite the type used.
- Composer requirement which should have already been there.

### Changed
- Make patches independent on project type.
- Files mapping to make clear which platforms the files are used for.

### Fixed
- Issue where magento 2 IDE files are installed in different projects like `Alumio` or `Laravel`.

## 2.3.0 - 2021-03-10
### Added
- Copyright.
- Declare strict type.

### Changed
- Vendor name from Mediact to Youwe