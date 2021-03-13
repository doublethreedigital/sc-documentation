---
title: 'Cart Drivers'
id: ac4252bd-cc1b-4218-8ed1-909f4827a82c
published: false
---
From v2.2 onwards, Simple Commerce provides a concept of 'Cart Drivers'.

Cart Drivers allow you to swap out how the current user's cart ID is stored. For example, by default, the cart ID is stored as a cookie in the user's browser. However, that can easilly be swapped out for being stored inside the user's session instead.

## Configuring

As with anything, you can configure your cart driver in your Simple Commerce config file (located in `config/simple-commerce.php`).

```php
/*
 |--------------------------------------------------------------------------
 | Cart
 |--------------------------------------------------------------------------
 |
 | Configure the Cart Driver in use on your site. It's what stores/gets the
 | Cart ID from the user's browser on every request.
 |
 */

'cart' => [
  'driver' => \DoubleThreeDigital\SimpleCommerce\Orders\Cart\Drivers\CookieDriver::class,
  'key' => 'simple-commerce-cart',
],
```

To change the driver, just replace the `driver` class with the class name for whichever driver you wish to use.

You can also configure the key that is used.

## Available Drivers

Simple Commerce provides two cart drivers out of the box.

* Session Driver
* Cookie Driver

## Building your own driver
If you don't want to use the session or a cookie for storing your customer's cart ID, you can build your own driver.

It's a relativly simple process. Create your own driver class, implement the required methods and add it to your config file.

```php
<?php

namespace App\CartDrivers;

use DoubleThreeDigital\SimpleCommerce\Contracts\CartDriver;
use DoubleThreeDigital\SimpleCommerce\Contracts\Order;

class YourDriver implements CartDriver
{
    public function getCartKey(): string
    {
        //
    }

    public function getCart(): Order
    {
        //
    }

    public function hasCart(): bool
    {
        //
    }

    public function makeCart(): Order
    {
        //
    }

    public function getOrMakeCart(): Order
    {
        //
    }

    public function forgetCart()
    {
        //
    }
}
```