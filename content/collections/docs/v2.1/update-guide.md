---
title: 'Update Guide'
id: c0af5012-07ae-4deb-b61d-1d4df22f43b4
origin: 1322d92b-74f9-485b-977e-ce981ec83ddb
---
## Updating from v2.0 to v2.1

We've tried to document as many of the breaking changes as we can. Although, if you have any custom integrations into Simple Commerce, we'd recommend that you [review the changes](https://github.com/doublethreedigital/simple-commerce/compare/master...v2.1-dev).

```s
composer update doublethreedigital/simple-commerce:^2.1
```

### New Configuration Values (breaking)
v2.1 added two new configuration values, `minimum_order_number` and `low_stock_threshold`. It's recommended to add these to your `config/simple-commerce.php` file...

```php
/*
    |--------------------------------------------------------------------------
    | Order Number
    |--------------------------------------------------------------------------
    |
    | If you want to, you can change the minimum order number for your store. This won't
    | affect past orders, just ones in the future.
    |
    */

    'minimum_order_number' => 2000,

    /*
    |--------------------------------------------------------------------------
    | Stock Running Low
    |--------------------------------------------------------------------------
    |
    | Simple Commerce can be configured to emit events when stock is running low for
    | products. Here is where you can configure the threshold when we start sending
    | those notifications.
    |
    */

    'low_stock_threshold' => 25,
```

### Updated notifications config (breaking)
In order to extend Simple Commerce's notifications system to work with back-office notifications, we've updated the notifications config. Please review the changes and update your config file:

```php
'notifications' => [
    'customer' => [
        'order_confirmation' => true,
    ],

    'back_office' => [
        'to' => 'staff@example.com',

        'order_paid' => true,
    ],
],
```

### Gateway Changes (breaking)
Instead of passing in arrays and request objects to various methods, Simple Commerce now has data transfer objects which will be passed into gateway methods. It's also expected that gateway methods will also return them.

Below is the updated gateway interface. Review your gateway for any changes:

```php
<?php

namespace DoubleThreeDigital\SimpleCommerce\Contracts;

use DoubleThreeDigital\SimpleCommerce\Data\Gateways\GatewayPrep;
use DoubleThreeDigital\SimpleCommerce\Data\Gateways\GatewayPurchase;
use DoubleThreeDigital\SimpleCommerce\Data\Gateways\GatewayResponse;
use Illuminate\Http\Request;
use Statamic\Entries\Entry;

interface Gateway
{
    public function name(): string;

    public function prepare(GatewayPrep $data): GatewayResponse;

    public function purchase(GatewayPurchase $data): GatewayResponse;

    public function purchaseRules(): array;

    public function getCharge(Entry $order): GatewayResponse;

    public function refundCharge(Entry $order): GatewayResponse;

    public function webhook(Request $request);
}
```

As well as changes to the methods, remember to add in the new `webhook` method and extend your gateway class from the `BaseGateway` for access to helper methods.

### Shipping Method Updates (breaking)
Shipping Method's haven't been updated hugely, it's just a small change to some of the method signatures. Review your shipping method against the Shipping Method interface:

```php
<?php

namespace DoubleThreeDigital\SimpleCommerce\Contracts;

use DoubleThreeDigital\SimpleCommerce\Data\Address;
use Statamic\Entries\Entry;

interface ShippingMethod
{
    public function name(): string;

    public function description(): string;

    public function calculateCost(Entry $order): int;

    public function checkAvailability(Address $address): bool;
}
```

### Translations and Views
If you published the Simple Commerce translations and views in v2.0, we recommend re-publishing them after updating to v2.1.

```s
php artisan vendor:publish --provider="DoubleThreeDigital\SimpleCommerce\ServiceProvider"
```

## API Changes
The namespaces of some of the API classes have been changes. If you're referencing them anywhere in your code, please review this list and change them.

* `DoubleThreeDigital\SimpleCommerce\Countries` -> `DoubleThreeDigital\SimpleCommerce\Data\Countries`
* `DoubleThreeDigital\SimpleCommerce\Currencies` -> `DoubleThreeDigital\SimpleCommerce\Data\Currencies`
