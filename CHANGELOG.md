# Changelog

All notable changes to `phpstan-config` will be documented in this file

## 4.0.0 - 2024-05-22

- Include `NoAbortIfRule` as additional rule
- Include `NoThrowIfRule` as additional rule
- Include `NoReportIfRule` as additional rule

## 3.1.0 - 2024-05-21

- Updated `tomasvotruba/type-coverage` to version 0.3.0

## 3.0.0 - 2024-05-18

- Updated `phpstan/phpstan` to version 1.11
- Updated `phpstan/phpstan-deprecation-rules` to version 1.2.0
- Updated `phpstan/phpstan-strict-rules` to version 1.6.0
- Updated `spaze/phpstan-disallowed-calls` to version 3.4.0

## 2.3.0 - 2024-05-06

- Updated `spaze/phpstan-disallowed-calls` to version 3.3.0

## 2.2.1 - 2024-04-30

- Updated `tomasvotruba/type-coverage` to version 0.2.8

## 2.2.0 - 2024-04-22

- Updated `spaze/phpstan-disallowed-calls` to version 3.2.0

## 2.1.0 - 2024-04-19

- Updated `phpstan/phpstan-strict-rules` to version 1.5.5
- Version lock `phpstan/phpstan-strict-rules`
- Version lock `phpstan/phpstan-deprecation-rules`
- Version lock `spaze/phpstan-disallowed-calls`

## 2.0.2 - 2024-04-17

- Updated `tomasvotruba/type-coverage` to version 0.2.7

## 2.0.1 - 2024-04-16

- Updated `phpstan/phpstan` to version 1.10.67

## 2.0.0 - 2024-04-05

- Introducing strict rules

## 1.3.7 - 2024-03-30

- Updated `phpstan/phpstan` to version 1.10.66

## 1.3.6 - 2024-03-25

- Updated `phpstan/phpstan` to version 1.10.65

## 1.3.5 - 2024-03-22

- Updated `phpstan/phpstan` to version 1.10.64

## 1.3.4 - 2024-03-19

- Updated `phpstan/phpstan` to version 1.10.63

## 1.3.3 - 2024-03-18

- Updated `tomasvotruba/type-coverage` to version 0.2.5

## 1.3.2 - 2024-03-15

- Version lock `tomasvotruba/type-coverage`

## 1.3.1 - 2024-03-13

- Updated `phpstan/phpstan` to version 1.10.62

## 1.3.0 - 2024-03-09

Added type coverage.

Enabled by default to have 100% coverage on parameters, properties and return types.

The new `typeCoverage(int $returnType, int $paramType, int $propertyType)` method on `Factory` can be used to change the individual type coverage percentage.

## 1.2.3 - 2024-03-07

- Updated `phpstan/phpstan` to version 1.10.60

## 1.2.2 - 2024-02-22

- Updated `phpstan/phpstan` to version 1.10.59

## 1.2.1 - 2024-02-16

- Updated `phpstan/phpstan` to version 1.10.58

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
