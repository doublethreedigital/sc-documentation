---
id: 3cbcad0c-d018-4bc6-95da-d4bf72428858
origin: b1a2ca6f-acd8-4712-9efa-08826dff5c96
---
One of the great things about Statamic is that everything is flat files which means you can put all your content in version control.

Having everything in version control is great for your content, you can see who changed things, when they changed it and you can rollback any accidents. Perfect for development!

However, when you're using Simple Commerce, everything is in flat-files, including your orders and customer information.

Depends on your setup, you may not want Statamic's Git integration to be committing everytime someone adds an item to their cart or makes a purchase. You could end up with a clutered Git history very quickly. There's a few solutions to this problem:

## 1. Use a different repo for your orders and customers
If you want to continue using version control but don't want orders and customers cluttering up your main repo, you could always setup a seperate Git repository where your orders and customers would live.

However, this solution is a bit fiddly to get setup with!

## 2. Don't use version control at all for orders and customers, just back them up instead
If you don't want orders and customer sitting in version control at all, you can just ignore them in your site's `.gitignore` file.

```s
content/collections/orders/*.md
content/collections/customers/*.md
```

Remember to backup your orders & collections though, especially now that they're not in version control. You could use something like [file backups on Snapshooter](https://snapshooter.io?via=duncanmcclean) to back them up on a regular basis.

## 3. Use a traditional database
The third option would be to use a traditional, old-school database, like you would with any other e-commerce solution.

Currently, Simple Commerce doesn't support saving orders or customers in a database but it's something on our roadmap for the near future.
