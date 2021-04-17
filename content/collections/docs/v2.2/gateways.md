---
id: f0a001d6-ceef-4e5a-9b55-6783b81d8eea
origin: b26a3fb4-9c34-4e6c-ae7d-b0e3efbc5f2e
---
Simple Commerce currently has built-in support for two popular payment providers: Stripe and Mollie.

If you need to use a payment provider that's not supported first-party, you can build your own.

And if you need a gateway that we don't already support, it's easy enough to [build your own](/latest/extending/custom-gateway).

## Configuration

Gateways can be configured in your `config/simple-commerce.php` file, under the `gateways` key.

```php
/*
|--------------------------------------------------------------------------
| Gateways
|--------------------------------------------------------------------------
|
| You can setup multiple payment gateways for your store with Simple Commerce.
| Here's where you can configure the gateways in use.
|
*/

'gateways' => [
    \DoubleThreeDigital\SimpleCommerce\Gateways\DummyGateway::class => [],
],
```

To add a gateway, just add the gateway's class name (`DummyGateway::class` syntax) as the array key and an array as the value. The array value can be used by the gateway for any configuration options, like API keys etc. If the gateway doesn't need any, just leave it an empty array.

## Dummy Gateway

If you're playing around with Simple Commerce or you haven't made your mind up on which payment provider to use, then the dummy gateway can come in helpful.

You can enter any Credit Card number, CVV and Expiry Date and the gateway will always return back successful.

## Stripe

First, you'll need to add Stripe to your `simple-commerce.php` config file. You will also need to pass in a `key` and `secret` file.

You can obtain [your API keys](https://dashboard.stripe.com/test/apikeys) from the Stripe Dashboard.

```php
'gateways' => [
	\DoubleThreeDigital\SimpleCommerce\Gateways\StripeGateway::class => [
    	'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
],
```

> It's best practice to use `.env` file for any API keys you need, rather than referencing them directly in your config file. [Review Statamic Docs](https://statamic.dev/configuration#environment-variables).

### Payment Form

Stripe recommend using their Elements library to capture credit card information as it means your customers' card information never touches your server, which is good for a whole load of reasons.

The payment form should be included inside your `{{ sc:checkout }}` form, and any Stripe Elements magic should also be wrapped in the `{{ sc:gateways }}` tag to ensure you can make full use of your gateway's configuration values.

A rough example of a Stripe Elements implementation is provided below.

```handlebars
<div>
    <label for="card-element">Card Details</label>
    <div id="card-element"></div>
</div>

<input id="stripePaymentMethod" type="hidden" name="payment_method">
<input type="hidden" name="gateway" value="DoubleThreeDigital\SimpleCommerce\Gateways\StripeGateway">

<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ gateway-config:key }}')
    var elements = stripe.elements()

    const card = elements.create('card')
    card.mount('#card-element')

    card.addEventListener('change', ({error}) => {
        // Deal with errors
    })

    function confirmPayment() {
        stripe.confirmCardPayment('{{ client_secret }}', {
            payment_method: { card: card },
        }).then(function (result) {
          	if (result.paymentIntent.status === 'succeeded') {
            	document.getElementById('stripePaymentMethod').value = result.paymentIntent.payment_method
            } else if (result.error) {
             	// Deal with errors
            }
        })
    }
</script>
```

Bearing in mind, you will need to use that inside of a `{{ sc:gateways }}` tag in order to use any values from your gateway config.

## Mollie

First, you'll need to add Mollie to your `simple-commerce.php` config file. You will also need to pass in a `key` and `secret` file.

You can obtain your API keys from the Mollie Dashboard.

![Mollie API Keys](/assets/mollie-dev-api-keys.png)

```php
'gateways' => [
	\DoubleThreeDigital\SimpleCommerce\Gateways\MollieGateway::class => [
    	'key' => env('MOLLIE_KEY'),
        'profile' => env('MOLLIE_PROFILE'),
    ],
],
```

> It's best practice to use `.env` file for any API keys you need, rather than referencing them directly in your config file. [Review Statamic Docs](https://statamic.dev/configuration#environment-variables).

### Payment flow

Mollie is an off-site gateway, which means the customer is redirected onto Mollie's checkout page to complete payment. Here's a quick run down of how the whole process works:

1. After filling out shipping info etc, the store redirects the customer to Mollie
2. The customer enters their payment information on Mollie's checkout
3. If the payment is successful, a webhook is sent to your server.
4. The customer is then redirected back to your site.

#### Handing the user off to Mollie's checkout

To redirect the customer off to Mollie's checkout page, you can use the `sc:checkout:mollie` tag.

```handlebars
{{ sc:checkout:mollie redirect="/thanks" error_redirect="/payment-error" }}
```

However, bear in mind that where-ever you use that tag, the customer will be redirected away from your site. So it's probably best to have it sitting on it's own page.

#### Handling Mollie's webhook

The Mollie gateway has a webhook which is hit by Mollie whenever a payment is made.

Simple Commerce will configure the webhook on Mollie's end. However, you'll need to add the webhook URL to your list of CSRF exceptions, found in `app/Http/Middleware/VerifyCsrfToken.php`.

```
protected $except = [
  '/!/simple-commerce/gateways/mollie/webhook',
];
```

When you're going through the payment flow in your development environment, you will need to use something like Expose or Ngrok to proxy request to your local server. Otherwise, Mollie wouldn't be able to hit the webhook. You will also need to update your `APP_URL` in your `.env`.

#### Handling the redirect back to your site

On the return back to your site from Mollie, you can have customers redirected to seperate URLs, depending on whether the payment was successful or failed/cancelled.

The `redirect` parameter on the `sc:checkout:mollie` tag will handle the successful payment redirects.

Where as `error_redirect` will handle any other payment states.
