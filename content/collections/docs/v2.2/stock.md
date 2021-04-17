---
id: e7a190c8-cf10-4ca2-b313-b78a246b1ef4
origin: 0d7935ee-2316-4bdc-9027-d0aa18b00372
---
To start using the stock functionality built into Simple Commerce, you'll need to add an [`Integer` field](https://statamic.dev/fieldtypes/integer#content), with the handle of `stock` to your product blueprint.

After that, you can populate your products with the correct amount of stock. Then, whenever a customer purhcases something on your store, the quantity of each product will be subtracted from the product's stock.

## Events

Simple Commerce will fire events when either your stock is [running low](https://sc-docs.doublethree.digital/latest/events#stockrunninglow) or if your [stock has ran out](https://sc-docs.doublethree.digital/latest/events#stockrunout) for one of your products.

You can configure the threshold for when you want to start dispatching the `StockRunningLow` event in your `simple-commerce.php` config.

```php
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
