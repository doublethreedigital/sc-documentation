---
title: 'Building a custom gateway'
id: 3ed91ad0-3ea1-4016-bb55-2f7e782effd9
---
There's a couple of cases where you might end up building a custom gateway. Either you need to extend an existing gateway and maybe send more/different information to the processor or you may need to connect with a payment processor that we don't include support for.


## Creating your gateway

To get you started, you can use the `make:gateway` command.

```
php please make:gateway PayMate
```

## Explaining the methods

The boilerplate gateway has quite a few methods. Here's a quick overview of what each gateway method does and what you should return.

* `name()` - should return the name of your gateway
* `prepare()` - should be used to either: generate tokens used later on for displaying the payment form or generating an off-site checkout link.
* `purchase()` - should be used to do the actual purchase (aka. taking the money from the customer)
* `purchaseRules` - should return an array of [Laravel Validation Rules](https://laravel.com/docs/master/validation#available-validation-rules) for the checkout request.
* `getCharge()` - should get information about a specific order's charge/transaction.
* `refundCharge()` - should refund an order
* `webhook()` - should accept incoming webhook payloads, used for off-site payment gateways.

## Gateway types

Simple Commerce supports two types of gateways: on-site and off-site.

**On-site gateways** are ones on which the customer will enter their credit card information on your site. As an example: think [Stripe Elements](https://stripe.com/en-gb/payments/elements).

**Off-site gateways** are ones where the customer is redirected to the payment processor in order to enter their payment information and then once entered, they will usually be redirected back to your website. [Mollie](https://www.mollie.com/) is a good example of this.

## DTOs

DTOs (also known as Data Transfer Objects) are used to return information back from your gateway to Simple Commerce so it can process it. There's a couple gateway related ones you'll need to know about:

* `GatewayPrepare`
* `GatewayPurchase`
* `GatewayResponse`

Each of these DTOs will have slightly different uses. You can view some examples of usage on some of the [built-in gateways](https://github.com/doublethreedigital/simple-commerce/tree/master/src/Gateways).