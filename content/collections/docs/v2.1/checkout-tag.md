---
title: 'Checkout Tag'
parent: e98d4e7b-3e63-4328-bacc-83ace3e2af42
id: f5705e8d-4481-440e-99f5-3902bb77feaa
---
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
