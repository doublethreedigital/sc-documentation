---
title: 'Extending Simple Commerce'
id: fbbabc6e-90e3-4eb8-a8a8-cadce1c3d047
origin: 8808e103-8b01-45c9-8612-334c3a471558
---
Simple Commerce provides a collection of API methods that developers can hook into to extend Simple Commerce.

We've tried to document some of the most popular APIs that Simple Commerce offers.

## Repositories
Simple Commerce is built upon the 'repository pattern'. You can access repositories by using the related facade. 

For example, if I wanted to get a customer from their email address, I'd do something like this:

```php
use DoubleThreeDigital\SimpleCommerce\Facades;

return Customer::findByEmail('duncan@example.com');
```

The repositories provided by Simple Commerce automatically works with Statamic's collections and entry system but say for example, you wanted to store customers in a database instead. You could write your own Customer Repository, implementing all of the same methods as the default one and you could switch to yours instead by adding this to your service provider.

```php
\Statamic\Statamic::repository(DoubleThreeDigital\SimpleCommerce\Contracts\CustomerRepository::class, App\Repositories\CustomerRepository::class);
```

## Events
Simple Commerce also has its own set of events that you can listen out for in your site. These can come in useful if you want to fulfill something once an order has completed or you want a Slack notification when a coupon has been redeemed.

To listen for events, you can use [Laravel's event listeners](https://laravel.com/docs/master/events#registering-events-and-listeners).