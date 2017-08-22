# Changelog

## [2.3.0](https://github.com/xyNNN/GoogleTagManagerBundle/tree/2.3.0) (2017-08-22)

[Full Changelog](https://github.com/xyNNN/GoogleTagManagerBundle/compare/2.2.0...2.3.0)

**Implemented enhancements:**

- Add support to push data to dataLayer that should not be in initial dataLayer in HEAD
- Will insert pushes to dataLayer variable at bottom of HTML output to not block rendering

## [2.2.0](https://github.com/xyNNN/GoogleTagManagerBundle/tree/2.2.0) (2017-08-21)

[Full Changelog](https://github.com/xyNNN/GoogleTagManagerBundle/compare/2.1.0...2.2.0)

**Implemented enhancements:**

- Support to merge variables set on multiple locations in code

## [2.1.0](https://github.com/xyNNN/GoogleTagManagerBundle/tree/2.1.0) (2017-05-03)

[Full Changelog](https://github.com/xyNNN/GoogleTagManagerBundle/compare/2.0.1...2.1.0)

**Implemented enhancements:**

- Split output for HEAD & for BODY
- Add support for Scrutinizer CI
- Add interface on GoogleTagManager service
- Refactor building of configuration
- Remove empty doc index file
- Require symfony/templating as helper is depending on it
- Move license to repository root
- Check for more recent PHP versions on Travis 

## [2.0.1](https://github.com/xyNNN/GoogleTagManagerBundle/tree/2.0.1) (2016-06-05)

[Full Changelog](https://github.com/xyNNN/GoogleTagManagerBundle/compare/2.0.0...2.0.1)

**Implemented enhancements:**

- Only append container in master request

## [2.0.0](https://github.com/xyNNN/GoogleTagManagerBundle/tree/2.0.0) (2016-04-18)

[Full Changelog](https://github.com/xyNNN/GoogleTagManagerBundle/compare/1.0.5...2.0.0)

**Implemented enhancements:**

- Updated symfony constraints to 2.8 and higher
- Removed deprecated ContainerAware abstract class with ContainerAwareTrait

## [1.0.5](https://github.com/xyNNN/GoogleTagManagerBundle/tree/1.0.5) (2015-08-12)

[Full Changelog](https://github.com/xyNNN/GoogleTagManagerBundle/compare/1.0.4...1.0.5)

**Implemented enhancements:**

- Allow to use multi-dimension array with Json and use native twig features

## [1.0.4](https://github.com/xyNNN/GoogleTagManagerBundle/tree/1.0.4) (2015-08-08)

[Full Changelog](https://github.com/xyNNN/GoogleTagManagerBundle/compare/1.0.3...1.0.4)

**Implemented enhancements:**

- Add EventListener to append Tag Manager Container automatically to HTML responses.

## [1.0.3](https://github.com/xyNNN/GoogleTagManagerBundle/tree/1.0.3) (2015-07-10)

[Full Changelog](https://github.com/xyNNN/GoogleTagManagerBundle/compare/1.0.2...1.0.3)

**Implemented enhancements:**

- Allow complex data structures, not just strings

## [1.0.2](https://github.com/xyNNN/GoogleTagManagerBundle/tree/1.0.2) (2015-06-12)

[Full Changelog](https://github.com/xyNNN/GoogleTagManagerBundle/compare/1.0.1...1.0.2)

**Implemented enhancements:**

- Replace hard-coded GTM ID with Twig variable.

## [1.0.1](https://github.com/xyNNN/GoogleTagManagerBundle/tree/1.0.1) (2015-03-23)

[Full Changelog](https://github.com/xyNNN/GoogleTagManagerBundle/compare/1.0.0...1.0.1)

**Implemented enhancements:**

- Added Travis CI
- Fixed error with composer dependencies
- Added CHANGELOG.md

## [1.0.0](https://github.com/xyNNN/GoogleTagManagerBundle/tree/1.0.0) (2015-03-22)

- First release is online!