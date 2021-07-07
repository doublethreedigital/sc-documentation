---
id: 88918a49-4e78-4882-9d07-bf14043bc0c9
origin: 8abc454f-0683-410e-9611-04bdc77b22e1
---
### Cart's Coupon
This tag lets you get the data for the coupon, if the customer has redeemed one for the cart.

```
{{ sc:coupon }}
  Currently redeemed: {{ slug }}
{{ /sc:coupon }}
```

### Check if coupon has been redeemed
This tag lets you check whether or not the customer has already redeemed a coupon.

```
{{ if {sc:coupon:has} === true }}
  Coupon Discount: {{ sc:cart:couponTotal }}
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
{{ sc:coupon:remove }}
  <button type="submit">Remove coupon</button>
{{ /sc:coupon:remove }}
```