---
title: 'Cart Cleanup'
parent: 3edefcbb-7318-4dfe-97f4-92b5ec997e5a
id: 4ffbe466-5813-43ed-b5b5-cff9251838d4
published: false
---
Simple Commerce provides a command, which can be setup to run automatically, that will delete any unpaid orders older than 14 days.

## Running command

To invoke the command, run `php please sc:cart-cleanup`. It'll work through the entries in your 'Orders' collection, find ones which aren't marked as paid, it'll then check the date of the entries. If they are older than 14 days, they will be deleted..

## Scheduling command

If you'd like, this command can be scheduled to run automatically, eg. like every night, to ensure that you don't have loads of unpaid orders liying about.

To schedule the command, add the below snippet to the `schedule` method of your `app/Console/Kernel.php` file.

```php
$schedule->command('sc:cart-cleanup')
  ->daily();
```

The snippet has it configured to run every day. If you'd like to run it more/less often, review the [Laravel scheduling documentation](https://laravel.com/docs/master/scheduling#scheduling-artisan-commands).