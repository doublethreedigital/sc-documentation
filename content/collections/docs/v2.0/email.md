---
title: Email
intro: 'Simple Commerce can be configured to send emails to customers and back-office staff when order''s have been paid for, etc.'
id: 22499319-3c9f-4546-b792-4054d47d57fd
---
By default, Simple Commmerce will automatically send emails to your customers when certain events happen. For example, Simple Commerce will send your customers an order confirmation email when a purchase has been completed.

## Configuration

```php
<?php

/*
|--------------------------------------------------------------------------
| Notifications
|--------------------------------------------------------------------------
|
| Simple Commerce can automatically send notifications to customers after
| events occur in your store. eg. a cart being completed.
|
| Here's where you can toggle if certain notifications are enabled/disabled.
|
*/

'notifications' => [
    'cart_confirmation' => true,
],
```

In your Simple Commerce config (`config/simple-commerce.php`), you can toggle notifications on or off, depending on your preference. For example, you may not want Simple Commerce to send an order confirmation email because Stripe might send one to the customer instead.

## Customising email views

Simple Commerce uses [Laravel's markdown mail](https://laravel.com/docs/7.x/mail#markdown-mailables) feature, meaning we can use Blade views with markdown in them and it will be sent as an email.

If you'd like to customise the text used, Simple Commerce automatically publishes them to your `resources/views/vendor/simple-commerce`.