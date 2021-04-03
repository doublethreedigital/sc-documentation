---
title: Email
id: 7dd95ad0-ce01-4d53-a31c-a253ecb44bb0
origin: 22499319-3c9f-4546-b792-4054d47d57fd
---
By default, Simple Commmerce will automatically send emails to your customers when certain events happen. For example, Simple Commerce will send your customers an order confirmation email when a purchase has been completed.

## Configuration

```php
/*
 |--------------------------------------------------------------------------
 | Notifications
 |--------------------------------------------------------------------------
 |
 | Simple Commerce can automatically send notifications after events occur in your store.
 | eg. a cart being completed.
 |
 | Here's where you can toggle if certain notifications are enabled/disabled.
 |
*/

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

In your Simple Commerce config (`config/simple-commerce.php`), you can toggle notifications on or off, depending on your preference. For example, you may not want Simple Commerce to send an order confirmation email because Stripe might send one to the customer instead.

## Back-office notifications

You can also send notifications to your store's back-office staff. To configure the email where those notifications go, change the `to` value. Currently it only supports sending to a single e-mail address.

## Customising email views

Simple Commerce uses [Laravel's markdown mail](https://laravel.com/docs/7.x/mail#markdown-mailables) feature, meaning we can use Blade views with markdown in them and it will be sent as an email.

If you'd like to customise the text used, Simple Commerce automatically publishes them to your `resources/views/vendor/simple-commerce`.