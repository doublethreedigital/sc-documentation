---
title: 'Coupon Tag'
parent: e98d4e7b-3e63-4328-bacc-83ace3e2af42
id: 0c771570-05f5-4fdd-bfb9-2462a28d4a3e
---
### Cart's Coupon
This tag lets you get the data for the coupon, if the customer has redeemed one for the cart.

```handlebars
{{ sc:coupon }}
  Current coupon: {{ slug }}
{{ /sc:coupon }}
```

### Check if coupon has been redeemed
This tag lets you check whether or not the customer has already redeemed a coupon.

```handlebars
{{ if {sc:coupon:has} === true }}
  You've redeemed a coupon.
{{ /if }}
```

### Redeem a coupoon
This tag lets you redeem a coupon.

```handlebars
{{ sc:coupon:redeem }}
  <input type="text" name="code">
{{ /sc:coupon:redeem }}
```

### Remove a coupon
This tag allows you remove a redeemed coupon from the cart.

```handlebars
{{ sc:cart:remove }}
  <button type="submit">Remove coupon</button>
{{ /sc:cart:remove }}
```
