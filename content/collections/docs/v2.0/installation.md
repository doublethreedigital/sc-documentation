---
title: Installation
intro: 'It''s as easy as 1, 2, 3, a, b, c. Seriously though, only two install steps, it''s mad.'
id: fe33ff01-b30c-45e7-8537-017f34a6c09d
---
## Requirements
Simple Commerce has a few requiements:
* Statamic 3 - it has it's [own set of requirements](https://statamic.dev/requirements)
* PHP 7.4
* `php-intl` PHP extension

We do however recommend that your site has SSL setup because you're going to be dealing with ecommerce and credit card information. [Lets Encrypt](https://letsencrypt.org/) can give you SSL certificates for free.

## Standard Install
We recommend installing Simple Commerce via the command line instead of through the Statamic Control Panel.

1. Install Simple Commerce with Composer

```s
composer require doublethreedigital/simple-commerce:v2.0
```

2. Publish Simple Commerce's vendor assets. This will give you our default blueprints, fieldtypes and configuration file.

```s
php artisan vendor:publish --provider="DoubleThreeDigital\SimpleCommerce\ServiceProvider"
```

3. Lastly, you'll need to setup the collections & taxonomies needed for Simple Commerce. You could do this manually or you can use the command that will do it for you.

```s
php please simple-commerce:setup-content
```

4. Get Started!

## Quick Start
If you'd prefer to get started with some boilerplate views and Simple Commerce already installed, you should checkout our the [Simple Commerce Starter Kit](https://github.com/doublethreedigital/simple-commerce-starter).
