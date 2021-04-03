---
title: 'Upgrade Guide'
id: 8cbbd066-9097-4110-aa99-458e797bfb23
origin: c0af5012-07ae-4deb-b61d-1d4df22f43b4
---
I've tried to document as many of the breaking changes as I can. Although, if you have any custom integrations into Simple Commerce, I'd recommend that you [review the changes](https://github.com/doublethreedigital/simple-commerce/compare/master...v2.2-dev).

```s
composer update doublethreedigital/simple-commerce:^2.2
```

1. Update dependency in `composer.json` to `^2.2` and run `composer update`.
2. Run `php please sc:upgrade` to automate the majority of changes.

## API changes
v2.2 contains a lot of updates to the way Simple Commerce works behind the scenes. There's a few notable changes to make if you're making use of Simple Commerce methods or facades.

### The `$cart` parameter on `CartCompleted` event has changed type

Instead of the `$cart` parameter being an `Entry` object, it is now an `Order` object.

### Cart Facade being phased out

The `Cart` facade is being phased out. It's strongly recommended that you update any references of the `Cart` facade to use the new `Order` facade which contains all of the same methods as the Cart facade.

It will continue to function for now, however the plan is to remove it completely in the next few major releases.

### Changes to Repositories

Simple Commerce used to split code into Repositories but it's been re-structured in v2.2, in order to cleanup the codebase for future development.

There's a few changes that you may need to make:

* Contracts have been renamed to remove `Repository` from the name. Example: `ProductRepository` is now `Product`.
* Repositories have moved from the `Repositories` namespace into ones for the individual features, like Order or Product.
* Repositories used to have separate `save` and `update` methods. These have been merged into a single `save` method which should be added to the end of a method chain, like below:

```php
Order::find('x-y-z')
  ->data(['items' => [...]])
  ->save();
```