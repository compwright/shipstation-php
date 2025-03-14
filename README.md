# compwright/shipstation-php

A [ShipStation](http://shipstation.com) v1/v2 API Client for PHP.

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Latest Version on Packagist][packagist-downloads]][link-packagist]

## Installation

This package can be installed via [Composer](http://getcomposer.org):

    composer require compwright/shipstation-php

## APIs

### V1 API

Coming soon

### V2 API

The V2 API client is auto-generated from [ShipStation's OpenAPI documentation](https://docs.shipstation.com/openapi). Two wrappers are provided that pull the API clients together into one class. Use the appropriate read-only property to access the desired endpoint.

`V2\ShippingApi` supports the following ShipStation V2 API endpoints:

* Batches
* Carriers
* Downloads
* Labels
* Manifests
* Package Pickups
* Package Types
* Rates
* Shipments
* Tags
* Tracking
* Webhooks

For those who have the Inventory API Add-On enabled, `V2\InventoryApi` includes all of the above, plus the following:

* Inventory
* Warehouses

## License

[MIT License](https://github.com/compwright/shipstation-php/blob/master/LICENSE)

[ico-version]: https://img.shields.io/packagist/v/compwright/shipstation-php.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/compwright/shipstation-php
[packagist-downloads]: https://img.shields.io/packagist/dt/compwright/shipstation-php.svg
