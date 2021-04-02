---
id: c287f66a-4c75-4982-9507-11963473c61e
origin: e98d4e7b-3e63-4328-bacc-83ace3e2af42
---
To help you integrate Simple Commerce into your Antlers templates, Simple Commerce provides various tags:

* [Cart](/v2.2/tags/cart-tag)
* [Checkout](/v2.2/tags/checkout-tag)
* [Coupon](/v2.2/tags/coupon-tag)
* [Customer](/v2.2/tags/customer-tag)
* [Gateways](/v2.2/tags/gateways-tag)
* [Shipping](/v2.2/tags/shipping-tag)
* [Countries](/v2.2/tags/countries-tag)
* [Currencies](/v2.2/tags/currencies-tag)

## Form Tags
Some Simple Commerce tags output `<form>` elements that submit to Simple Commerce endpoints. There's a couple of optional parameters you can add to form tags.

* `redirect` - the URL where you'd like to redirect the user after a successful form submission.
* `error_redirect` - the URL where you'd like to redirect the user after any validation errors are thrown by the form.

```handlebars
{{ sc:cart:addItem redirect="/cart" }}
    <input type="hidden" name="product" value="{{ id }}">
    <input type="hidden" name="quantity" value="1">
    <button class="button-primary">Add to Cart</button>
{{ /sc:cart:addItem }}
```

## Support for Blade & Twig

At the moment, I've got no plans to introduce first-party support for using Laravel Blade or Twig as templating languages with Simple Commerce.

While I'm sure it can be done, it's not something that I'd recommend doing. Personally, I'm a huge fan of Antlers, so it's not something I'm planning on supporting any time soon.

## Alias

If you'd prefer not to use the shorthand of `sc` in your tags, you can also use `simple-commerce` which will work the same way.

This could be used to give more context of the tag in use to make it clear it's dealing with Simple Commerce.

```handlebars
{{ simple-commerce:countries }}
```