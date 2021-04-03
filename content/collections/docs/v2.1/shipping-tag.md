---
title: 'Shipping Tag'
parent: e98d4e7b-3e63-4328-bacc-83ace3e2af42
id: 0c9c9a0f-f56e-464f-9b82-1b3abb96377f
---
### Get Shipping Methods
This tag can be used to give the user the option to select which shipping method they'd like their order to go through. The tag will loop through all of your configured shipping methods, see if they are available for the order's shipping address and if they are, the details and price will be outputted.

```handlebars
<select name="shipping_method" value="{{ old:shipping_method }}">
  <option value="" disabled selected>Select a Shipping Method</option>
  {{ sc:shipping:methods }}
    <option value="{{ handle }}">{{ name }} - {{ cost }}</option>
  {{ /sc:shipping:methods }}
</select>
```
