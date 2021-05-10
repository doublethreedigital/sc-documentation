---
title: 'Using a mail view, instead of a Laravel Notification'
seo_noindex: false
seo_nofollow: false
seo_canonical_type: entry
sitemap_change_frequency: weekly
sitemap_priority: 0.5
parent: 4a03faf4-c2aa-4a52-ab40-950a400d343f
id: 9615bee4-5863-4fe7-aaa5-17f8379b3048
published: false
---
With the v2.3 upgrade, Simple Commerce changed the way it handles email notifications. Previously, it used [Laravel Mailables](https://laravel.com/docs/master/mail#writing-mailables), now it uses [Laravel Notifications](https://laravel.com/docs/master/notifications).

Before v2.3, the contents of the emails were contained inside Blade or Antler views which live inside `resources/views`.

You may not have enough time to convert your emails to use the [`MailMessage`](https://laravel.com/docs/master/notifications#mail-notifications) format for writing emails or maybe you just plain out prefer using views for your emails.

Here's a quick, short & sweet snippet on doing exactly that!

* 1. Use your own notification

## 1. Use your own notification

The first thing you'll need to do is to create your own notification and override that within the `simple-commerce.php` config.

You can generate a notification like so:

```
php artisan make:notification OrderPaidNotification
```

```php
// app/Notifications/OrderPaid.php

// TODO: class boilerlate
```

```php
// config/simple-commerce.php

'notifications' => [
    'order_paid' => [
        \DoubleThreeDigital\SimpleCommerce\Notifications\CustomerOrderPaid::class   => ['to' => 'customer'],
        \DoubleThreeDigital\SimpleCommerce\Notifications\BackOfficeOrderPaid::class => ['to' => 'duncan@example.com'],
    ],
],
```

## 2. 

Meh.