# Changelog

All notable changes to `phpstan-config` will be documented in this file

## 11.0.0 - 2025-01-..

- Updated `phpstan/phpstan` to version 2.0.3
- Updated `phpstan/phpstan-deprecation-rules` to version 2.0.1
- Updated `phpstan/phpstan-strict-rules` to version 2.0.0
- Updated `rector/type-perfect` to version 2.0.0
- Updated `spaze/phpstan-disallowed-calls` to version 4.0.1
- Updated `tomasvotruba/type-coverage` to version 2.0.0

## 10.0.2 - 2024-11-07

- Updated `phpstan/phpstan` to version 1.12.8

## 10.0.1 - 2024-10-28

- Updated `phpstan/phpstan` to version 1.12.7
- Updated `spaze/phpstan-disallowed-calls` to version 3.5.1

## 10.0.0 - 2024-10-04

- Type coverage now also uses constants, defaults to 100%
- Dependency update

## 9.0.3 - 2024-10-01

- Updated `phpstan/phpstan` to version 1.12.5

## 9.0.2 - 2024-09-23

- Updated `phpstan-strict-rules` to version 1.6.1
- Updated `phpstan/phpstan` to version 1.12.4

## 9.0.1 - 2024-09-13

- Updated `phpstan/phpstan-deprecation-rules` to version 1.2.1

## 9.0.0 - 2024-09-09

- Updated `rector/type-perfect` to version 0.2.0
- Updated `phpstan/phpstan` to version 1.12.3

Breaking change:

- `$noMixed` argument on `typePerfect` method replaced with `$noMixedProperty` and `$noMixedCaller`.

## 8.1.1 - 2024-09-06

- Updated `phpstan/phpstan` to version 1.12.2

## 8.1.0 - 2024-09-03

- Updated `phpstan/phpstan` to version 1.12.0

## 8.0.1 - 2024-08-13

- Updated `phpstan/phpstan` to version 1.11.10

## 8.0.0 - 2024-08-05

- Added `DisallowedLaravelDieDumpFunctionsRule`
- Dropped `DisallowedLaravelHelperMethodsRule`
- Updated `phpstan/phpstan` to version 1.11.9

## 7.0.0 - 2024-07-09

- New `mutableDatetime` rule that disallows using mutable DateTime instances/functions

## 6.1.0 - 2024-07-09

- Updated `rector/type-perfect` to version 0.1.8
- Updated `phpstan/phpstan` to version 1.11.7

## 6.0.0 - 2024-06-18

- Uses `rector/type-perfect` by default
- Updated `phpstan/phpstan` to version 1.11.5

## 5.0.0 - 2024-06-17

- Dropped PHP 8.2 support
- Updated `phpstan/phpstan` to version 1.11.4
- Updated `tomasvotruba/type-coverage` to version 0.3.1

## 4.2.1 - 2024-05-31

- Updated `phpstan/phpstan` to version 1.11.3

## 4.2.0 - 2024-05-25

- Updated `phpstan/phpstan` to version 1.11.2
- Combine disallowed Laravel helper methods into `DisallowedLaravelHelperMethodsRule`

## 4.1.0 - 2024-05-23

- Include `NoBlankRule` as additional rule

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
