# Morningtrain\WP\ACFHelper

Some helpers to standialize Advanced Custom Fields (ACF) use in our projects.

## Table of Contents

- [Introduction](#introduction)
- [Getting Started](#getting-started)
    - [Installation](#installation)
- [Usage](#usage)
- [Credits](#credits)
- [License](#license)

## Introduction

This package is made to standialize the way we are using Advanced Custom Fields (ACF) in our projects. 

It makes it easy to handle ACF JSON files, hide ACF administration area and check if ACF is not installed or activated on the site.

## Getting Started

To get started install the package as described below in [Installation](#installation).

To use the package have a look at [Usage](#usage)

### Installation

Install with composer.

```composer require morningtrain/wp-acf-helper```

## Usage

### Add JSON folder

To add a foldere where ACF should look for JSON field groups

```php
// Add folder to look for JSON files in ./resources/acf-fields
\Morningtrain\WP\ACFHelper\ACFHelper::registerJsonFolder(__DIR__ . '/resources/acf-fields');
```

#### Use JSON folder as save folder

To use the added JSON folder as the folder where ACF use the `useAsSaveFolder` method on the returned `JsonPath` object.
You can optionally set a namespace, which is used to force saving in specific folder if more than one project sets a save folder.

*OBS: ACF will not create the folder, so it shall exist before ACF saves in the folder.*

```php
// Add folder to look for JSON files in ./resources/acf-fields and use it as save folder
\Morningtrain\WP\ACFHelper\ACFHelper::registerJsonFolder(__DIR__ . '/resources/acf-fields')->useAsSaveFolder('some_namespace');
```

If you will force saving in your folder, define a constant in `wp-config.php` with the namespace set in `useAsSaveFolder`.

```php
define('ACF_SAVE_FOLDER', 'some_namespace');
```

### Hide Administration

To hide aministration from the WP backend.

```php
\Morningtrain\WP\ACFHelper\ACFHelper::hideAdmin();
```

This will hide ACF from the WP administration.

#### Hide Administration Except On Specific Environments

You can hide admin except on specific environments defined by `WP_ENVIRONMENT_TYPE` in `wp-config.php`. 

```php
\Morningtrain\WP\ACFHelper\ACFHelper::hideAdminExceptOn([
    'local',
    'development'
]);
```

Possible values are ‘local’, ‘development’, ‘staging’, and ‘production’.

To define the environment add this to *wp-config.php*

```php
define('WP_ENVIRONMENT_TYPE', 'local');
```

### Check if ACF is installed and activated
To check if ACF is activated

```php
// Abort if ACF is not activated
if(!\Morningtrain\WP\ACFHelper\ACFHelper::isACFActivated()) {
    return;
}
```

## Credits

- [Martin Schadegg Brønniche](https://github.com/mschadegg)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.