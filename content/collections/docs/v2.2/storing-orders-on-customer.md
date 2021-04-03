---
title: 'Storing Orders on Customer'
parent: 3edefcbb-7318-4dfe-97f4-92b5ec997e5a
id: 9f972e3e-2515-4de9-b7f3-803546245ec0
---
Sometimes you may run into a situation where you'd like to keep track of a customer's orders on their customer entry, instead of just attaching the customers from the order side.

On checkout, the ID of the order entry will be added to the customer's entry inside an `orders` array. If you wish to display this array in your Control Panel, create an [Entries field](https://statamic.dev/fieldtypes/entries#content), with the `orders` handle.

## With `{{ sc:customer:orders }}` tag

In the future, the plan is to make the customer entry the source of truth for all order IDs but as this feature was introduced mid-version, a breaking change could not be introduced.

Therefore, a `from="customer"` parameter will need to be provided when using the tag, see below.

```handlebars
{{ sc:customers:orders from="customer"}}
  <!-- And all your order stuff -->
{{ /sc:customers:orders }}
```

_This feature was implemented after a feature request, [see Discussion](https://github.com/doublethreedigital/simple-commerce/discussions/369)._