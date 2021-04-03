---
title: Tags
id: 6b491282-e792-431a-bc6a-912ee9b60edc
---
Simple Commerce provides a bunch of tags to help you to integrate it inside your templates.

## Cart

### The whole cart
Gets the customer's cart so you can get details from it. Say you wanted the id of the cart for some reason, here's how that would work.

```handlebars
{{ sc:cart }}
 <p>The ID of your cart is {{ id }}</p>
{{ /sc:cart }}
```

### Cart Check
This tag allows you to check whether or not the customer currently has a cart attached to their session, it returns a boolean.

```handlebars
{{ if {sc:cart:has} === true }}
  ...
{{ /if }}
```

### Cart Items
Returns a loop of all the items in the customer's cart.

```handlebars
{{ sc:cart:items }}
  {{ quantity }}x {{ product:title }}
{{ /sc:cart:items }}
```

### Items Count
Gives you a count of how many items are in the customer's cart.

```handlebars
{{ sc:cart:count }}
```

### Totals
**Grand Total**
Returns the total of all the other totals. In fact, there's two ways of doing it.

```handlebars
This... {{ sc:cart:total }}

Does exactly the same thing as this... {{ sc:cart:grand_total }}
```

**Items Total**
Returns the total of every item in the cart.

```handlebars
{{ sc:cart:items_total }}
```

**Shipping Total**
Returns the shipping total of the cart.

```handlebars
{{ sc:cart:shipping_total }}
```

**Tax Total**
Returns the tax total of the cart.

```handlebars
{{ sc:cart:tax_total }}
```

**Coupon Total**
Returns the total of the coupons in the cart.

```handlebars
{{ sc:cart:coupon_total }}
```

### Add Cart Item
This tag allows you to add an item to your cart.

```handlebars
{{ sc:cart:addItem }}
  <input type="hidden" name="product" value="{{ id }}">
  <input type="number" name="quantity" value="2">
{{ /sc:cart:addItem }}
```

### Update Cart Item
This tag allows you to update the items in the cart.

```handlebars
{{ sc:cart:updateItem :item="id" }}
  <input type="number" name="quantity" value="2">
{{ /sc:cart:updateItem }}
```

### Remove Cart Item
This tag allows you to remove an existing item from the cart.

```handlebars
{{ sc:cart:removeItem :item="id" }}
  <button type="submit">Remove item from cart</button>
{{ /sc:cart:removeItem }}
```

### Update cart
This tag allows you to update data in the cart. Any form inputs will automatically be saved to the order entry.

```handlebars
{{ sc:cart:update }}
  <input type="text" name="delivery_note">
{{ /sc:cart:update }}
```

> **Hot Tip:** If you want to also update the customer at the same time, something like the below should work. Remember the `email`, it's required.

```handlebars
<input type="text" name="customer[name]">
<input type="email" name="customer[email]">
```

### Empty cart
This tag removes all the items in the cart.

```handlebars
{{ sc:cart:empty }}
  ...
{{ /sc:cart:empty }}
```

## Checkout
This tag allows you to checkout the cart. Inside the tag, you can use any of the data from your cart. The `redirect` parameter is recommended so you can redirect the customer to a success page when they're order has been confirmed.

Like with the update cart tag, you can also pass information to the customer entry. Don't forget the `email` field though as it's required.

```handlebars
{{ sc:checkout redirect="/thanks" }}
  {{ if is_paid }}
  <p>Checkout complete! <a href="{{ receipt_url }}">Download</a> your receipt.</p>
  {{ else }}
    <input type="text" name="customer[name]" placeholder="Full Name">
    <input type="email" name="customer[email]" placeholder="Email">

    <input type="text" name="gift_note" placeholder="Gift Note">

    <select name="gateway">
      {{ simple-commerce:gateways }}
        <option value="{{ class }}">{{ name }}</option>
      {{ /simple-commerce:gateways }}
    </select>

    <!-- deal with your gateway stuff -->

    <button type="submit">Checkout</button>
  {{ /if }}
{{ /sc:checkout }}
```

## Coupons

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
{{ sc:cart:redeem }}
  <input type="text" name="code">
{{ /sc:cart:redeem }}
```

### Remove a coupon
This tag allows you remove a redeemed coupon from the cart.

```handlebars
{{ sc:cart:remove }}
  <button type="submit">Remove coupon</button>
{{ /sc:cart:remove }}
```

## Customer

## Get a customer
This tag allows you to get a customer by their ID. Remember to provide the `id` parameter which should be the ID of the customer.

```handlebars
{{ sc:customer id="ff7ddbf2-cd01-4689-a57f-26cb2e7c96f9" }}
  Your name is {{ name }} and your email is {{ email }}.
{{ /sc:customer }}
```

### Update a customer
This tag allows you to update an existing customer. Remember to provide the `id` parameter which should be the ID of the customer.

```handlebars
{{ sc:customer:update id="ff7ddbf2-cd01-4689-a57f-26cb2e7c96f9" }}
  <input type="text" name="name">
{{ /sc:customer:update }}
```

### Get orders by customer
This tag allows you to loop through orders created by a customer. Remember to provide the `customer` parameter which should be the ID of the customer.

```handlebars
{{ sc:customer:orders customer="ff7ddbf2-cd01-4689-a57f-26cb2e7c96f9" }}
  {{ title }} - {{ grand_total }}
{{ /sc:customer:orders }}
```

### Get order by customer
This tag allows you to get an order created by a customer. This tag has two parameters. `id` for the ID of the order you want to get and `customer` is the ID of the customer you want to get.

```handlebars
{{ sc:customer:order customer="ff7ddbf2-cd01-4689-a57f-26cb2e7c96f9" id="84b28c73-3a04-478f-9447-68df026c44fe" }}
  {{ title }} - {{ grand_total }}
{{ /sc:customer:order }}
```

## Gateways

### All gateways
This tag returns a loop of the gateways setup for your store.

```handlebars
{{ sc:gateways }}
  {{ name }}
{{ /sc:gateways }}
```

### Get a gateway
This tag lets you get a particular gateway and its information, where `stripe` is the handle of the gateway.

```handlebars
{{ sc:gateways:stripe }}
  {{ name }}
{{ /sc:gateways:stripe }}
```

## Shipping
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

## Get countries
This tag lets you loop through countries.

```handlebars
{{ sc:countries }}
  <option value="{{ iso }}">{{ name }}</option>
{{ /sc:countries }}
```

## Get currencies
This tag lets you loop through currencies.

```handlebars
{{ sc:currencies }}
  {{ name }} - {{ symbol }}
{{ /sc:currencies }}
```

## And a few things...
If you're dealing with forms built by a Simple Commerce tag, there's a few cool things you can do.

Firstly, you can add a `redirect` param so you can redirect your user once they submit the form (and the validation is successful). In this example, the form will redirect to `/cart`.

```handlebars
{{ sc:cart:addItem redirect="/cart" }}
    <input type="hidden" name="product" value="{{ id }}">
    <input type="hidden" name="quantity" value="1">
    <button class="button-primary">Add to Cart</button>
{{ /sc:cart:addItem }}
```

Also, if you don't like prefixing `sc` in the tags, you can use `simple-commerce` instead.
