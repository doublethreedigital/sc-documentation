---
id: f0a001d6-ceef-4e5a-9b55-6783b81d8eea
origin: b26a3fb4-9c34-4e6c-ae7d-b0e3efbc5f2e
---
Simple Commerce has built-in support for popular payment gateways, including Stripe and Mollie.

And if you need a gateway that we don't already support, it's easy enough to build your own.

## Configuration

Gateways are configured in your `config/simple-commerce.php` file. Like so:

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

## Built-in gateways

Here's the list of popular payment gateways that Simple Commerce supports out of the box.

* Stripe
* Mollie

### Dummy

In the case when you're building out your checkout process and you haven't decided on a payment processor or you're just playing around with Simple Commerce and don't want to setup a 'real' payment gateway, the dummy one can come in useful.

You can enter any credit card number, any cvv and any expiry and the card will always return successful.

### Stripe

To get started, add the Stripe gateway to your gateway configuration:

```php
'gateways' => [
	\DoubleThreeDigital\SimpleCommerce\Gateways\StripeGateway::class => [
    	'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
],
```

> **🔥 Hot Tip:** Use [environment variables](https://statamic.dev/configuration#environment-variables) for the API Key and Secret so they're never committed to version control.

You can see an example payment form using Stripe Elements, in the [Simple Commerce Starter Kit](https://github.com/doublethreedigital/sc-starter-kit/blob/master/resources/views/checkout/gateways/_stripe.antlers.html).

### Mollie

To get started, add the Mollie gateway to your gateway configuration:

```php
'gateways' => [
	\DoubleThreeDigital\SimpleCommerce\Gateways\MollieGateway::class => [
    	'key' => env('MOLLIE_KEY'),
        'profile' => env('MOLLIE_PROFILE'),
    ],
],
```

> **🔥 Hot Tip:** Use [environment variables](https://statamic.dev/configuration#environment-variables) for the API Key and Profile so they're never committed to version control.

Another thing you'll need to do is setup a webhook inside Mollie's Dashboard. This is how Mollie's system will communicate with Simple Commerce. The webhook URL is: `yourdomain.com/!/simple-commerce/gateways/mollie/webhook`.

Because of Mollie being a complete off-site gateway, no payment form is provided. Instead, you'll need to redirect users to Mollie's hosted checkout page where the customer can complete the payment process. After they pay, they will be redirected back to your site.

You can learn more about off-site gateways below.

### Custom Gateway

There are often cases where you'll need to use a gateway that Simple Commerce doesn't provide out of the box. In those cases, you will need to build your own:

1. Run `php please make:gateway {gateway}`, obviously replacing `{gateway}` with the name of your gateway. The gateway will be created in `App\Gateways`.

2. Fill in the blanks! Review each of the methods, filling in the ones you need. Here's a quick breakdown of each of the methods.

* `name()` - should return the name of your gateway
* `prepare()` - should be used to either: generate tokens used later on for displaying the payment form or generating an off-site checkout link.
* `purchase()` - should be used to do the actual purchase (aka. taking the money from the customer)
* `purchaseRules` - should return [Laravel Validation Rules](https://laravel.com/docs/master/validation#available-validation-rules) for the checkout request.
* `getCharge()` - should get information about a specific order's charge/transaction.
* `refundCharge()` - should refund an order
* `webhook()` - should accept incoming webhook payloads, used for off-site payment gateways.

## Templating

### On-site gateways

On-site gateways is where the customer is kept on the store's website to enter their payment information, Stripe is the primary on-site gateway we support.

Usually, the payment form would be on the last step in your checkout flow, inside the `{{ sc:checkout }}` tag. Make sure to provide the gateway being used in the checkout form.

The implementation of on-site gateways vary depending on the gateway. However, we've provided a bare-bones example below, showing usage with the built-in Stripe gateway.

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

Inside checkout forms, you can access the gateway's configuration options and anything it returns in it's `prepare` method.

For example: `{{ gateway-config:key }}` fetches the `key` property from the gateway's config. And the `{{ client_secret }}` is returned from the Stripe Gateway during it's `prepare` method.

#### Multiple on-site gateways

If you want to give the customer a choice of how they want to pay (bank transfer or credit card, for example), you can offer the customer a choice of payment methods by looping through the `{{ sc:gateways }}` tag.

In the below example, we're using Alpine.js to react to the value of the `<select>` element. We'd also recommend splitting the payment forms into their own partials.

```handlebars
<div x-data="{ gateway: '{{ sc:gateways }}{{ if first }}{{ formatted_class }}{{ /if }}{{ /sc:gateways }}' }">
	<h2>Secure Payment</h2>

	<select
    	x-model="gateway"
        class="h-10 w-full border rounded p-2 mb-2 outline-none mr-2"
        name="gateway"
    >
		{{ sc:gateways }}
			<option value="{{ class }}">{{ name }}</option>
		{{ /sc:gateways }}
	</select>

    {{ sc:gateways }}
		<div x-show="gateway === '{{ formatted_class }}'">
			<!-- Payment form partial -->
		</div>
	{{ /sc:gateways }}

    <button
    	type="button"
        @click.prevent="if(typeof confirmPayment == 'function' && document.getElementsByName('gateway')[0].value == 'DoubleThreeDigital\\SimpleCommerce\\Gateways\\StripeGateway') { confirmPayment(); } else { document.querySelector('form').submit() }">
        Complete Checkout
	</button>
</div>
```

### Off-site gateways

Off-site gateways are where the customer is redirected away from the store's website to a payment processor. Mollie is the off-site gateway built in with Simple Commerce.

When you want to use an off-site gateway, you can't use the standard `{{ sc:checkout }}` tag as the customer needs to be redirected elsewhere to complete the checkout process.

Below is an example of the off-site gateway checkout tag for Mollie. You can obviously change the gateway name and the redirect to work for you.

```handlebars
{{ sc:checkout:mollie redirect="/thanks" error_redirect="/payment-error" }}
```

After the customer completes payment on the off-site gateway they will be redirected back to your store's site. Either to the redirect URL provided or to your store's homepage.

Behind the scenes, the customer's payment confirmation will be sent via webhooks to your gateway.

## Using webhooks
Some gateways offer webhooks, a way for your gateway to report back to Simple Commerce about payment statuses etc. Webhook URLs look like this: `https://yoursite.com/!/simple-commerce/mollie/webhook`.

Most gateways will require you to setup the webhook endpoint on their website. However, others may automatically set the webhook when Simple Commerce creates a transaction.

Webhooks will also need to bypass [Laravel's CSRF verification](https://laravel.com/docs/8.x/csrf). You can configure CSRF exceptions in your `app/Http/Middleware/VerifyCsrfToken.php` file.

```php
protected $except = [
  '/!/simple-commerce/gateways/mollie/webhook',
];
```