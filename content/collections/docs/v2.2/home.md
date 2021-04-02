---
id: a7e9819c-ec55-4f37-b2c5-f2ec11ffc514
origin: ce8337dc-8a1f-4caa-b99c-b67215c00149
---
From the very start, Simple Commerce has been built with a mission to feel as native to Statamic as possible. 

It uses markdown files for your products & orders, it doesn't force you away from Antlers and it doesn't tell you what your content schema should look like. **It's all up to you!**

## How does it all work?

### Content

Under the hood, all of your orders, products, coupons are just normal Statamic entries. This also gives you the flexibility to update your blueprint without any loop holes.

The great thing about your products being entries is that you can loop through them the same way you can with any other collection:

```handlebars
{{ collection:products }}
  <h2>{{ title }}</h2>
  <p>{{ price }}</p>
{{ /collection:products }}
```

### Templating

Antlers is Statamic's templating language. Personally, I ❤️ it! Simple Commerce ships with its own set of [Antler Tags](/v2.2/tags).

Here's example usage for the `{{ sc:cart:addItem }}` tag which generates a form to add a product to the cart. This is what the Antlers code looks like:

```handlebars
{{ sc:cart:addItem }}
    <input type="hidden" name="product" value="{{ id }}">
    <input type="hidden" name="quantity" value="1">
    <button class="button-primary">Add to Cart</button>
{{ /sc:cart:addItem }}
```

And here's what it outputs:

```html
<form action="/!/simple-commerce/cart-items" method="post">
    <input type="hidden" name="product" value="84b28c73-3a04-478f-9447-68df026c44fe">
    <input type="hidden" name="quantity" value="1">
    <button class="button-primary">Add to Cart</button>
</form>
```

## And the details...

For each production site you launch, you need to buy a $99 license which is purchasable from the Statamic Marketplace.

If you've got any questions, [drop me an email](mailto:hello@doublethree.digital). And for any bugs, [create a GitHub issue](https://github.com/doublethreedigital/simple-commerce/issues/new?assignees=&labels=&template=bug_report.md).