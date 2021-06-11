---
id: da067989-9512-4973-afd5-71a4903c5fd3
origin: c287f66a-4c75-4982-9507-11963473c61e
---
To help you integrate Simple Commerce into your Antlers templates, Simple Commerce provides various tags:

* [Cart](/v2.3/tags/cart-tag)
* [Checkout](/v2.3/tags/checkout-tag)
* [Coupon](/v2.3/tags/coupon-tag)
* [Customer](/v2.3/tags/customer-tag)
* [Gateways](/v2.3/tags/gateways-tag)
* [Shipping](/v2.3/tags/shipping-tag)
* [Countries](/v2.3/tags/countries-tag)
* [Currencies](/v2.3/tags/currencies-tag)

## Form Tags
Some Simple Commerce tags output `<form>` elements that submit to Simple Commerce endpoints. There's a couple of optional parameters you can add to form tags.

* `redirect` - the URL where you'd like to redirect the user after a successful form submission.
* `error_redirect` - the URL where you'd like to redirect the user after any validation errors are thrown by the form.
* `request` - the name of the [Form Request](https://laravel.com/docs/master/validation#creating-form-requests) you wish to use for validation of the form.

```handlebars
{{ sc:cart:addItem redirect="/cart" }}
    <input type="hidden" name="product" value="{{ id }}">
    <input type="hidden" name="quantity" value="1">
    <button class="button-primary">Add to Cart</button>
{{ /sc:cart:addItem }}
```

### Validation

Like noted above, you can use the `request` parameter when creating form tags to specify a [Form Request](https://laravel.com/docs/master/validation#creating-form-requests) to be used for validation purposes. You can either tell it the full class name (including the namespace) or without it.

```handlebars
{{## Form Request: app\Http\Requests\CheckoutInformationRequest ##}}

{{ sc:cart:update request="CheckoutInformationRequest" }}

{{ /sc:cart:update }}
```

Although you can specify the `request` parameter on any form tag, not all of them will actually use it. Here's a list of the forms that do:

* `{{ sc:cart:addItem }}`
* `{{ sc:cart:updateItem }}`
* `{{ sc:cart:update }}`
* `{{ sc:customer:update }}`
* `{{ sc:checkout }}`

## Blade support

At the moment, I've not got any plans to introduce first-party support for Blade (or any similar templating languages for that metter).

## Alias

If you'd prefer not to use the shorthand of `sc` in your tags, you can also use `simple-commerce` which will work the same way.

This could be used to give more context of the tag in use to make it clear it's dealing with Simple Commerce.

```handlebars
{{ simple-commerce:countries }}
```