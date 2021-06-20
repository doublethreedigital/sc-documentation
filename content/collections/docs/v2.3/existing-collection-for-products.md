---
title: 'Using an existing collection for Simple Commerce Products'
seo_noindex: false
seo_nofollow: false
seo_canonical_type: entry
sitemap_change_frequency: weekly
sitemap_priority: 0.5
id: ede77e4e-8243-4ca9-9f40-bbef39ea64bc
---
There's some cases where you'll need to bring in Simple Commerce to allow charging for events or tickets. 

You may also already have a collection for events or tickets and you want to continue to use that collection, instead of a brand new 'Products' collection.

Here's a really simple guide of how to use an existing collection for Simple Commerce's products.

## 1. Install Simple Commerce

If you've not already, you'll need to install Simple Commerce. There's documentation on doing that [right over here](https://sc-docs.doublethree.digital/v2.3/installation#standard-install).

## 2. Configuration (and delete 'Products Collection')

Once installed, you'll need to tell Simple Commerce which collection you want to use as your 'products' collection. This is easily changed in your config file.

```php
// config/simple-commerce.php

return [

    /*
    |--------------------------------------------------------------------------
    | Content Drivers
    |--------------------------------------------------------------------------
    |
    | Normally, all of your products, orders, coupons & customers are stored as flat
    | file entries. This works great for small stores where you want to keep everything
    | simple. However, for more complex stores, you may want store your data somewhere else
    | (like a database). Here's where you'd swap that out.
    |
    | https://sc-docs.doublethree.digital/v2.3/extending/content-drivers
    |
    */

    'content' => [
        ...

        'products' => [
            'driver' => \DoubleThreeDigital\SimpleCommerce\Products\Product::class,
            'collection' => 'products', // handle of your collection
        ],

		...
    ],
];
```

Just update the `collection` variable to match the handle of the collection you'd like to use instead.

When you installed Simple Commerce, it will have created a 'Products' collection by default. It's safe to delete it now.

## 3. Add price field to existing blueprint

Now that we're using one of your existing collections to hold your products, you'll need to add a 'Price' field.

Simple Commerce provides its own 'Money' fieldtype which should be used for this field. It's available in the blueprint builder.

TODO

> This field will need to have the handle of `price` or else Simple Commerce won't be able to find it.

## 4. All ready!

And that's you! All ready to start off on your Simple Commerce journey!