---
title: Configuring
intro: 'Simple Commerce provides a configuration file out of the box, to help you configure your store.'
id: 74427f4f-8485-4ee9-a0ec-a729a78e59a5
---
During addon installation, a `config/simple-commerce.php` is published in your project. This is the file where your Simple Commerce configuration lives.

## Site configuration
Statamic has a concept of sites. Each Statamic instance can have one or more sites. For each of those sites you can use a different currency, a different tax configuration and different shipping methods.

```php
/*
|--------------------------------------------------------------------------
| Sites
|--------------------------------------------------------------------------
|
| For each of your Statamic sites, you can setup a new store which allows you
| to use different currencies, tax rates and shipping methods.
|
*/

'sites' => [
    'default' => [
        'currency' => 'GBP',

        'tax' => [
            'rate' => 20,
            'included_in_prices' => false,
        ],

        'shipping' => [
            'methods' => [
                \DoubleThreeDigital\SimpleCommerce\Shipping\StandardPost::class,
            ],
        ],
    ],
],
```

Whenever you want to add another site to Simple Commerce, just change the array key from `default` to your new one. Remember to keep the site key the same between the Simple Commerce config and the Statamic config.

```
'sites' => [
    'default' => [...],
    'french' => [...],
],
```

> **Hot Tip:** Also remember that if you're wanting to use multiple sites, you'll need to [purchase & enable Statamic Pro](https://statamic.dev/licensing).

Let's walk through some of the configuration options you have with each site.

* The first option is currency, you can use a variety of different currencies in Simple Commerce. To configure one, just put in the three letter currency code and it should be picked up.

* Tax is another thing you can configure. The default configuration has the tax rate setup at 20% and that the product prices include tax. You can obviusly change this to whatever you'd like.

* Each site can have its own set of shipping methods. A lot of sites have custom shipping rules, so we recommend you build one specifically for your site. <!-- TODO: write documentation on doing this -->

## Gateways
Simple Commerce has quite a few [built-in payment gateways](/simple-commerce/gateways), as always its something you build custom for your store.

```php
/*
|--------------------------------------------------------------------------
| Gateways
|--------------------------------------------------------------------------
|
| You can setup multiple payment gateways for your store with Simple Commerce.
| Here's where you can configure the gateways in use.
|
*/

'gateways' => [
    \DoubleThreeDigital\SimpleCommerce\Gateways\DummyGateway::class => [],
],
```

To add a gateway, just add the gateway's class name (`DummyGateway::class` syntax) as the array key and an array as the value. The value is normally used for any gateway configuration. If your gateway doesn't have any configuration options, just leave it as an empty array.

## Notifications
```php
/*
|--------------------------------------------------------------------------
| Notifications
|--------------------------------------------------------------------------
|
| Simple Commerce can automatically send notifications to customers after
| events occur in your store. eg. a cart being completed.
|
| Here's where you can toggle if certain notifications are enabled/disabled.
|
*/

'notifications' => [
    'cart_confirmation' => true,
],
```

Simple Commerce can be configured to automatically send emails to your customers when certain events happen. For example, an order confirmation email when an order has been completed.

We've written a bit more about Notification configuration [over here](/simple-commerce/email).

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

If you'd like to change the collections and handles used for certain things in Simple Commerce, we allow you to do that. Just change the appropriate value to the handle of the collection you'd like to use instead.

For example, to use a collection called `Discounts`, with a handle of `discounts` for your orders, you could configure that like this:

```php
'collections' => [
    ...,
    'coupons' => 'discounts',
],
```

## Various other options
There's a few smaller configuration options too. We've documented them in some bullet points below.

* `cart_key` will determine the session key used for a customers' cart.
