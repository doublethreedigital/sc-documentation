---
id: e4a9d14e-6488-4e7c-9464-e2546d9ac2c1
origin: 12fc1059-6d1f-4bbc-8bf5-25a6e25039e8
---
During addon installation, a `config/simple-commerce.php` is published in your project, this is where your Simple Commerce configuration lives.

Most of the available configuration options are documented alongside the feature documentation. This page documents the rest of the configuration options.

## Site configuration

I've moved our documentation about configuring sites over to a new [Multi-site](/v2.3/multi-site) page.

## Collections & Taxonomies
```php
/*
|--------------------------------------------------------------------------
| Collections & Taxonomies
|--------------------------------------------------------------------------
|
| Simple Commerce uses Statamic's native collections and taxonomies functionality.
| It will automatically create collections/taxonomies upon addon installation if
| they don't already exist. However, if you'd like to use a different collection
| or taxonomy, like one you've already setup, here's the place to change that.
|
*/

'collections' => [
    'products' => 'products',
    'orders' => 'orders',
    'coupons' => 'coupons',
],

'taxonomies' => [
    'product_categories' => 'product_categories',
    'order_statuses'     => 'order_statuses',
],
```

If you'd prefer to use different names for collections that what Simple Commerce ships with, you can do that. Simply update the appropriate value to the handle of the collection/taxonomy you'd like to use.

For example, to use a collection called `Discounts`, with a handle of `discounts` for your coupons, you could configure that like this:

```php
'collections' => [
    ...,
    'coupons' => 'discounts',
],
```

## Various other options
There's a few smaller configuration options too. I've documented them in some bullet points below.

* `cart_key` will determine the session key used for a customers' cart.
* `minimum_order_number` allows you to set the minimum for order numbers to start at. By default it is `2000`, so order title's will be `#2000`, `#2001`, etc