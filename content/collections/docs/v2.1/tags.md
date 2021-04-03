---
title: Tags
id: e98d4e7b-3e63-4328-bacc-83ace3e2af42
origin: 6b491282-e792-431a-bc6a-912ee9b60edc
---
To help you integrate Simple Commerce into your Antlers templates, Simple Commerce provides various tags:

* [Cart](/v2.1/tags/cart-tag)
* [Checkout](/v2.1/tags/checkout-tag)
* [Coupon](/v2.1/tags/coupon-tag)
* [Customer](/v2.1/tags/customer-tag)
* [Gateways](/v2.1/tags/gateways-tag)
* [Shipping](/v2.1/tags/shipping-tag)
* [Countries](/v2.1/tags/countries-tag)
* [Currencies](/v2.1/tags/currencies-tag)

## Form Tags
Some Simple Commerce tags output `<form>` elements that submit to Simple Commerce endpoints. There's a couple of optional parameters you can add to form tags.

* `redirect` - the URL where you'd like to redirect the user after a successful form submission.

```handlebars
{{ sc:cart:addItem redirect="/cart" }}
    <input type="hidden" name="product" value="{{ id }}">
    <input type="hidden" name="quantity" value="1">
    <button class="button-primary">Add to Cart</button>
{{ /sc:cart:addItem }}
```

## Support for Blade & Twig

At the moment, we have no plans to introduce first-party support for using Laravel Blade or Twig as templating languages with Simple Commerce.

While I'm sure it can be done, it's not something that we recommend doing. We love Antlers so it's likley all we're going to be supporting for the time being.

## Alias

If you'd prefer not to use the shorthand of `sc` in your tags, you can also use `simple-commerce` which will work the same way.

This could be used to give more context of the tag in use to make it clear it's dealing with Simple Commerce.

```handlebars
{{ simple-commerce:countries }}
```
