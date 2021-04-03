---
title: Stock
intro: 'Simple Commerce can help you automatically keep track of your stock so you don''t run out of products.'
id: 0d7935ee-2316-4bdc-9027-d0aa18b00372
---
To start using the stock functionality built into Simple Commerce, you'll need to add an [`Integer` field](https://statamic.dev/fieldtypes/integer#content), with the handle of `stock` to your product blueprint.

After that, you can populate your products with the correct amount of stock. Then, whenever a customer purhcases something on your store, the quantity of each product will be subtracted from the product's stock.

## Events
Simple Commerce includes two events to do with stock: [`StockRunningLow`](https://github.com/doublethreedigital/simple-commerce/blob/master/src/Events/StockRunningLow.php) and [`StockRunOut`](https://github.com/doublethreedigital/simple-commerce/blob/master/src/Events/StockRunOut.php). They will be dispatched when the stock on one of your products is running low or has indeed run out.

You can configure the threshold for when you want to start dispatching the `StockRunningLow` event in your `config/simple-commerce.php` file.

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