# GoogleTagManagerBundle

[![Software License](https://img.shields.io/badge/license-LGPL%203.0-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://travis-ci.org/xyNNN/GoogleTagManagerBundle.svg?branch=master)](https://travis-ci.org/xyNNN/GoogleTagManagerBundle)

The GoogleTagManagerBundle provides you an easy-to-use method to integrate the Google Tag Manager into your Symfony 2 application.

> Note: This Bundle is still in development. Feel free to report encountered issues!

## Requirements

- [x] PHP 5.3 and higher
- [x] Symfony 2.8 and higher

## Install

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require xynnn/google-tag-manager-bundle "~2.0"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding the following line in the `app/AppKernel.php`
file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Xynnn\GoogleTagManagerBundle\GoogleTagManagerBundle(),
        );

        // ...
    }

    // ...
}
```

### Step 3: Enable Google Tag Manager

Add the configuration to your yaml file. Please don't forget to adjust your Google Tag Manager Id.

### Step 4: Insert the ViewHelper

Insert the ViewHelper into your layout file to enable the Google Tag Manager.
Please be aware to insert into right after the HTML body tag!

```html
<body>
{{ google_tag_manager() }}
...
</body>
```

### Step 5: Fill up the DataLayer from Google Tag Manager (Optional)

If you want to send some information to the Google Tag Manager, you can use the dataLayer.

```php
/** @var GoogleTagManager $manager */
$manager = $this->get('google_tag_manager');
$manager->addData('example', 'value');
```

## Configuration

```yaml
google_tag_manager:
    enabled: true
    id: "GTM-XXXXXX"
    autoAppend: true|false
```

## Authors

**Philipp Bräutigam**

+ [github/xyNNN](https://github.com/xyNNN)
+ [twitter/pbraeutigam](http://twitter.com/pbraeutigam)

## License
Copyright (c) 2015 Philipp Bräutigam
This repository is released under the GNU LGPL v3.0 license.
