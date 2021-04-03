---
title: Installation
id: 5f2341fc-ba8c-4530-b7a6-3abfa1b09be4
origin: fe33ff01-b30c-45e7-8537-017f34a6c09d
---
## Requirements
Simple Commerce has a few requiements:
* Statamic 3 - it has it's [own set of requirements](https://statamic.dev/requirements)
* PHP 7.4
* `php-intl` PHP extension

While not a requirement, we recommend you have an SSL certificate for your production site.

## Standard Install
We recommend installing Simple Commerce via the command line instead of through the Statamic Control Panel.

**1.** Install Simple Commerce with Composer

```s
composer require doublethreedigital/simple-commerce
```

**2.** Run `php please sc:install` - it'll publish the Simple Commerce default blueprints, configuration file and will setup collections and taxonomies.

**3.** That's it installed. Really simple.

## Quick Start
If you'd prefer to get started with some boilerplate views and Simple Commerce already installed, you should checkout our the [Simple Commerce Starter Kit](https://github.com/doublethreedigital/simple-commerce-starter).
