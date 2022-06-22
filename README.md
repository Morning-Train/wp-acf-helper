# WP ACF

Some helpers to standialize Advanced Custom Fields (ACF) use in our projects.

## Table of Contents

- [Introduction](#introduction)
- [Getting Started](#getting-started)
    - [Installation](#installation)
- [Usage](#usage)

## Introduction

This package is made to standialize the way we are using Advanced Custom Fields (ACF) in our projects. 

It makes it easy to handle ACF JSON files, hide ACF administration area and check if ACF is not installed or activated on the site, and notify adminstrators.

## Getting Started

To get started install the package as described below in [Installation](#installation).

To use the package have a look at [Usage](#usage)

### Installation

Install with composer.

```composer require morningtrain/wp-acf```

## Usage

### Add JSON folder

To add a foldere where ACF should look for JSON field groups

```php
// Add folder to look for JSON files in ./resources/acf-fields
\Morningtrain\WP\ACF\ACF::registerJsonFolder(__DIR__ . '/resources/acf-fields');
```

#### Use JSON folder as save folder

To use the added JSON folder as the folder where ACF use the `useAsSaveFolder` method on the returned `JsonPath` objetct.
You can optionally set a namespace, which is used to force saving in specific folder if more than one project sets a save folder.

```php
// Add folder to look for JSON files in ./resources/acf-fields and use it as save folder
\Morningtrain\WP\ACF\ACF::registerJsonFolder(__DIR__ . '/resources/acf-fields')->useAsSaveFolder('some_namespace');
```

If you will force saving in your folder, define a constant in `wp-config.php` with the namespace set in `useAsSaveFolder`.

```php
define('ACF_SAVE_FOLDER', 'some_namespace');
```

### Hide Administration

To hide aministration from te WP backend.

```php
\Morningtrain\WP\ACF\ACF::hideAdmin();
```

This will hide ACF from the WP administration except on local environments. Define `WP_ENVIRONMENT_TYPE` in `wp-config.php` to display it locally.

```php
define('WP_ENVIRONMENT_TYPE', 'local');
```

### Check if ACF is installed and activated
To check if ACF is activated

```php
// Abort if ACF is not activated
if(!\Morningtrain\WP\ACF\ACF::isACFActivated();) {
    return;
}
```

#### Display admin notice if ACF is not installed or activated
:construction: WIP