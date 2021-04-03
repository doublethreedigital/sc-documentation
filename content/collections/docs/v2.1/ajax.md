---
title: 'Using with AJAX'
intro: 'Using AJAX takes a little bit of effort but it''s worth it to make a truly custom e-commerce site.'
id: 871bec5a-4c52-48c9-9f45-9800a40f33cd
---
Normally, you can use Simple Commerce's [form tags](https://sc-docs.doublethree.digital/v2.1/tags#form-tags) to build HTML `<form>` elements to do actions, such as adding to the cart or submitting a user's payment information during checkout.

However, sometimes you may want to use AJAX instead of forms as you don't need to wait for a page refresh after submitting data.

Submitting via AJAX is totally possible, it just takes a little bit more effort on your end when building your sites.

## Endpoints

Each of the [form tags](https://sc-docs.doublethree.digital/v2.1/tags#form-tags) point to different endpoints. 

The easiest way to figure out which endpoint you want to use in place of a form tag would be to use the form tag temporarily in your template and grab the outputted form `action`.

If you're super duper interested, here's [the routes file](https://github.com/doublethreedigital/simple-commerce/blob/master/routes/actions.php), in case there's any 'hidden' routes we don't provide a tag for (spoiler: there's a couple).

You can send any of the same parameters to the endpoints as documented in the respective tag.

Instead of returning redirects when you submit actions, a JSON response will be returned, containing the request status, a message and any assosiated resources, like the current cart.

```json
{
 	"status": "success",
  	"message": "Cart Updated",
  	"cart": {...}
}
```

## CSRF

CSRF is a feature of Laravel which essentially helps to prevent request spoofing by providing a token only available to the current user's specific session.

When making POST/DELETE requests to Simple Commerce endpoints, remember to provide a `_token` parameter with a CSRF token.

```js
let params = {
	'_token': '{{ csrf_token }}'
}
```

## Example

Here's a quick & basic example of using Axios to make an HTTP request to one of Simple Commerce's endpoints.

```js
let params = {
	'_token': '{{ csrf_token }}',
  	'product': 'your-product-id',
  	'quantity': 1
}

axios.post('/!/simple-commerce/cart-items', params)
	.then((response) => {
		console.alert('Whoop! The product has been added to your cart')
	})
```