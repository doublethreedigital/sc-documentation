---
title: Gateways
intro: 'Simple Commerce has first-party support for popular payment gateways like Stripe and Mollie. You can also build your own gateway, if needed.'
id: 55b09797-572a-483b-b5af-9d277c1744c6
---
Simple Commerce ~~has~~ will have built-in support for popular payment gateways, like Stripe. However, if we don't support your gateway of choice, it's easy enough to build one yourself.

## Configuration

Gateways are configured in your `config/simple-commerce.php` file. Like so:

```php
'gateways' => [
    \DoubleThreeDigital\SimpleCommerce\Gateways\DummyGateway::class => [],
],
```

The array key is the gateway class and the key should contain an array of settings for the gateway, such as API keys.

## Built-in gateways

Here's the list of popular payment gateways that Simple Commerce supports out of the box.

* Stripe (recommended)
* More coming soon!

### Dummy Gateway

We provide a dummy gateway which can be helpful for testing/prototyping, before you've decided on a particular gateway. When using the dummy gateway, all payments will be returned as successful, unless you use the card number `1212 1212 1212 1212`, where the payment will fail.

We include an example of the payment form for the Dummy gateway in the [Simple Commerce starter kit](https://github.com/doublethreedigital/simple-commerce-starter).

### Stripe Gateway

Stripe is the gateway we recommend, mostly because its modern and easy to use for both merchants and customers. To use the Stripe gateway in your store, add the Stripe class, followed by your Stripe API details as settings.

```php
'gateways' => [
        \DoubleThreeDigital\SimpleCommerce\Gateways\StripeGateway::class => [
            'key' => env('STRIPE_KEY'),
            'secret' => env('STRIPE_SECRET'),
        ],
],
```

We would highly recommend making use of [environment variables](https://statamic.dev/configuration#environment-variables) to store your Stripe API details so they don't get leaked in version control (even if it's private).

We include an example of the payment form for the Stripe gateway in the [Simple Commerce starter kit](https://github.com/doublethreedigital/simple-commerce-starter).

## Build your own gateway

Sometimes you'll want to use a gateway that Simple Commerce doesn't provide out of the box. In that case, you'll need to make your own gateway.

1. Create a gateway from a stub, you can copy over the stub by running `php please make:gateway {gateway name}`. The gateway will be created in your `App\Gateways` folder.

```php
<?php

namespace App\Gateways;

use DoubleThreeDigital\SimpleCommerce\Contracts\Gateway;

class SuperCoolGateway implements Gateway
{
    public function name(): string
    {
        return 'Super Cool';
    }

    public function prepare(array $data): array
    {
        return [];
    }

    public function purchase(array $data): array
    {
        return [];
    }

    public function purchaseRules(): array
    {
        return [];
    }

    public function getCharge(array $data): array
    {
        return [];
    }

    public function refundCharge(array $data): array
    {
        return [];
    }
}
```

2. Now all you need to do is fill in the blank methods to make them work for your gateway. Here's a quick overview of what each of the methods do:

* **name** - This method should return the name of your gateway. It's recommended this name should be recognisable.
* **prepare** - This method is called while loading the `sc:checkout` form. If you need to, you can return an array of stuff which will be available as variables inside the form.
* **purchase** - This method is called when the customer submits the `sc:checkout` form. `$data` will be everything sent to the checkout form. This is where you'll want to confirm the purchase.
* **purchaseRules** - This method should return an array of [validation rules](https://laravel.com/docs/7.x/validation#available-validation-rules) which will be used to make sure the request contains everything it needs to hit the `purchase` method later on.
* **getCharge** - This method will be hit anytime Simple Commerce needs to get gateway information.
* **refundCharge** - This method will be hit whenever a refund should happen. `$data` will be an array of the order's entry data.
