---
title: 'Data Classes'
id: c6249284-fe49-4018-9dfe-a924fd42bdfc
---
If you've dug into the Simple Commerce codebase even a little bit, you'll probably see lots of places where it references an `Order`, `Coupon` or `Product` facade.

Each of these Facades are bound via Laravel's service container, to a 'concrete' implementation of the class. 

For example, when you call the `find` method on the `Order` facade. Under the hood, you're really calling the `find` method on the `src/Orders/Order.php` class, that's where all of the actual logic is happening.

## Binding your own data class

If you want to override how a certain part of the `Order` class works for example. You can create your own `Order` class, extend on top of the base one and you can then bind that with Simple Commerce.

```php
// app/Providers/AppServiceProvider.php

use Statamic\Statamic;

...

public function register()
{
	Statamic::repository(
      DoubleThreeDigital\SimpleCommerce\Contracts\Order::class,
      App\YourOrderClass::class
    );
}
```

Make sure that your class implements the relevant contract or else you'll run into issues.