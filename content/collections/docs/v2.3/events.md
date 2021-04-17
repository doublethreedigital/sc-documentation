---
id: 26012503-fd9a-463a-9cde-c2e9a0d9816c
origin: 5ca7272b-da30-4033-a2f9-d1864ca5311e
---
Events can be useful if you need to listen out for when certain things in your application happen.

Simple Commerce provides a couple of events to help make your life easier.

## Listening for events

First, you'll need a Listener class. You can generate one by running `php artisan make:listener NameOfListener`. It'll generate a file in `App\Listeners`.

In the `handle` function of your event listener, that's where you write your logic that you need to happen when a certain event is triggered.

```php
class NameOfListener
{
    public function handle(NameOfEvent $event)
    {
        //
    }
}
```

Before your listener will actually listen to an event, you need to hook it up. You can do this in your `EventServiceProvider`, located in `App\Providers`.

```php
protected $listen = [
	NameOfEvent::class => [
    	NameOfListener::class,
    ],
];
```

And there you go, you have a listener listening to an event!

For more documentation around events and event listeners, consider reading [the Laravel documentation](https://laravel.com/docs/events).

## Available events

### CartCompleted

[**`DoubleThreeDigital\SimpleCommerce\Events\CartCompleted`**](https://github.com/doublethreedigital/simple-commerce/blob/master/src/Events/CartCompleted.php)

This event is fired when an order/cart is complete and has been paid, usually after checking out.

```php
public function handle(CartCompleted $event)
{
	$event->cart;
  	$event->order;
}
```

### CartSaved

[**`DoubleThreeDigital\SimpleCommerce\Events\CartSaved`**](https://github.com/doublethreedigital/simple-commerce/blob/master/src/Events/CartSaved.php)

This event is fired when an order/cart has been saved.

```php
public function handle(CartSaved $event)
{
	$event->cart;
}
```

### CartUpdated

[**`DoubleThreeDigital\SimpleCommerce\Events\CartUpdated`**](https://github.com/doublethreedigital/simple-commerce/blob/master/src/Events/CartUpdated.php)

**I'd recommend you use the `CartSaved` event instead. The `CartUpdated` will be deprecated in future versions.**

This event is fired when an order/cart has been saved.

```php
public function handle(CartUpdated $event)
{
	$event->cart;
}
```

### CouponRedeemed

[**`DoubleThreeDigital\SimpleCommerce\Events\CouponRedeemed`**](https://github.com/doublethreedigital/simple-commerce/blob/master/src/Events/CouponRedeemed.php)

This event is fired when a customer adds a coupon to their cart/order.

```php
public function handle(CouponRedeemed $event)
{
	$event->coupon;
}
```

### CustomerAddedToCart

[**`DoubleThreeDigital\SimpleCommerce\Events\CustomerAddedToCart`**](https://github.com/doublethreedigital/simple-commerce/blob/master/src/Events/CustomerAddedToCart.php)

This event is fired when a customer is attached to a cart/order.

```php
public function handle(CustomerAddedToCart $event)
{
	$event->cart;
}
```

### PostCheckout

[**`DoubleThreeDigital\SimpleCommerce\Events\PostCheckout`**](https://github.com/doublethreedigital/simple-commerce/blob/master/src/Events/PostCheckout.php)

This event is fired after the checkout process has been completed.

```php
public function handle(PostCheckout $event)
{
	$event->data;
}
```

### PreCheckout

[**`DoubleThreeDigital\SimpleCommerce\Events\PreCheckout`**](https://github.com/doublethreedigital/simple-commerce/blob/master/src/Events/PreCheckout.php)

This event is fired before the checkout process begins.

```php
public function handle(PreCheckout $event)
{
	$event->data;
}
```

### ReceiveGatewayWebhook

[**`DoubleThreeDigital\SimpleCommerce\Events\ReceiveGatewayWebhook`**](https://github.com/doublethreedigital/simple-commerce/blob/master/src/Events/ReceiveGatewayWebhook.php)

This event is fired whenever a webhook request from a gateway is received.

```php
public function handle(ReceiveGatewayWebhook $event)
{
	$event->payload;
}
```

### StockRunOut

[**`DoubleThreeDigital\SimpleCommerce\Events\StockRunOut`**](https://github.com/doublethreedigital/simple-commerce/blob/master/src/Events/StockRunOut.php)

This event is fired when the [stock](https://sc-docs.doublethree.digital/latest/stock) for a product has ran out.

```php
public function handle(StockRunOut $event)
{
	$event->product;
    $event->stock;
}
```

### StockRunningLow

[**`DoubleThreeDigital\SimpleCommerce\Events\StockRunningLow`**](https://github.com/doublethreedigital/simple-commerce/blob/master/src/Events/StockRunningLow.php)

This event is fired when the [stock](https://sc-docs.doublethree.digital/latest/stock) for a product is running low.

```php
public function handle(StockRunningLow $event)
{
	$event->product;
    $event->stock;
}
```
