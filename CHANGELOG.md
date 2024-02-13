# Changelog

All notable changes to `phpstan-config` will be documented in this file

## 1.2.0 - 2024-02-13

- Pin down `phpstan/phpstan` version
- Add new configuration methods to `Factory` class
  - `allowDangerousCalls()` - disables dangerous calls check
  - `allowExecutionCalls()` - disables execution calls check
  - `allowInsecureCalls()` - disables insecure calls check
  - `allowLooseCalls()` - disables loose calls check

## 1.1.1 - 2024-02-02

- Fix `NoDumpRule` namespace

## 1.1.0 - 2024-02-02

- Include `NoDumpRule` as additional rule

## 1.0.1 - 2024-02-02

- Fix `exclude` method

## 1.0.0 - 2024-02-02

- Initial release
