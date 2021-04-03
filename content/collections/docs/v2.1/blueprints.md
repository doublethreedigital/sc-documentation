---
title: Blueprints
id: 0bd36b3a-d7a4-46ee-9e3c-a822f4850560
published: false
---
Blueprints are a core feature of Statamic. They let you define the fields used in your entries, taxonomies, etc.

Since Simple Commerce is built upon Entries, it makes heavy use of blueprints. 

Simple Commerce _enforces_ a couple of fields which it needs to make everything work together. Things like a price field on products and total fields in your orders.

Although, we don't want to make your content structures too opinionated so there's some fields that are behind the scenes of orders, for things like payment IDs from gateways.