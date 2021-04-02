---
title: 'Gateways Tag'
parent: e98d4e7b-3e63-4328-bacc-83ace3e2af42
id: bc911ab7-2954-48fc-ab01-fd889a39d812
---
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
