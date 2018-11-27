# zoho-invoice-client-bundle

[![build status](https://git.chaplean.coop/open-source/bundle/zoho-invoice-client-bundle/badges/master/build.svg)](https://git.chaplean.coop/open-source/bundle/zoho-invoice-client-bundle/commits/master)
[![build status](https://git.chaplean.coop/open-source/bundle/zoho-invoice-client-bundle/badges/master/coverage.svg)](https://git.chaplean.coop/open-source/bundle/zoho-invoice-client-bundle/commits/master)
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/chaplean/zoho-invoice-client-bundle/issues)

This bundle allows you to use the [zoho invoice api](https://www.zoho.com/invoice/api/v3/) easily from your php code.

## Table of content

* [Installation](#Installation)
* [Configuration](#Configuration)
* [Usage](#Usage)
* [Versioning](#Versioning)
* [Contributing](#Contributing)
* [Hacking](#Hacking)
* [License](#License)

## Installation

This bundle requires at least Symfony 3.0.

You can use [composer](https://getcomposer.org) to install zoho-invoice-client-bundle:
```bash
composer require chaplean/zoho-invoice-client-bundle
```

Then add to your AppKernel.php:

```php
new Chaplean\Bundle\ZohoInvoiceClientBundle\ChapleanZohoInvoiceClientBundle(),
```

## Configuration

First you will need to import the bundle configuration.

config.yml:
```yaml
imports:
    - { resource: '@ChapleanZohoBooksClientBundle/Resources/config/config.yml' }
```

You must also create some parameters.

parameters.yml:
```yaml
parameters:
    chaplean_zoho_invoice.organization_id: f545ff15s4g
    chaplean_zoho_invoice.access_token: g45df45g41g5fd
```

## Usage

See the rest-client-bundle's [usage documentation](https://github.com/chaplean/rest-client-bundle#using-a-bundle-based-on-rest-client-bundle).

### Available functions:

* [Items](https://www.zoho.com/invoice/api/v3/#Items)
    * [getItem()](https://www.zoho.com/invoice/api/v3/#Items_Retrieve_an_item)
    * [getItems()](https://www.zoho.com/invoice/api/v3/#Items_List_items)
    * [postItem()](https://www.zoho.com/invoice/api/v3/#Items_Create_an_Item)
    * [putItem()](https://www.zoho.com/invoice/api/v3/#Items_Update_an_item)
    * [deleteItem()](https://www.zoho.com/invoice/api/v3/#Items_Delete_an_item)
    * [postItemActive()](https://www.zoho.com/invoice/api/v3/#Items_Mark_as_active)
    * [postItemInactive()](https://www.zoho.com/invoice/api/v3/#Items_Mark_as_inactive)

* [Estimate](https://www.zoho.com/invoice/api/v3/#Estimates)
    * [getEstimate()](https://www.zoho.com/invoice/api/v3/#Estimates_Get_an_estimate)
    * [getEstimates()](https://www.zoho.com/invoice/api/v3/#Estimates_List_estimates)
    * [postEstimate()](https://www.zoho.com/invoice/api/v3/#Estimates_Create_an_Estimate)
    * [putEstimate()](https://www.zoho.com/invoice/api/v3/#Estimates_Update_an_Estimate)
    * [deleteEstimate()](https://www.zoho.com/invoice/api/v3/#Estimates_Delete_an_Estimate)

* [Invoice](https://www.zoho.com/invoice/api/v3/#Invoices)
    * [getInvoice()](https://www.zoho.com/invoice/api/v3/#Invoices_Get_an_invoice)
    * [getInvoices()](https://www.zoho.com/invoice/api/v3/#Invoices_List_invoices)
    * [postInvoice()](https://www.zoho.com/invoice/api/v3/#Invoices_Create_an_invoice)
    * [putInvoice()](https://www.zoho.com/invoice/api/v3/#Invoices_Update_an_invoice)
    * [deleteInvoice()](https://www.zoho.com/invoice/api/v3/#Invoices_Delete_an_invoice)

## Versioning

zoho-invoice-client-bundle follows [semantic versioning](https://semver.org/). In short the scheme is MAJOR.MINOR.PATCH where
1. MAJOR is bumped when there is a breaking change,
2. MINOR is bumped when a new feature is added in a backward-compatible way,
3. PATCH is bumped when a bug is fixed in a backward-compatible way.

Versions bellow 1.0.0 are considered experimental and breaking changes may occur at any time.

## Contributing

Contributions are welcomed! There are many ways to contribute, and we appreciate all of them. Here are some of the major ones:

* [Bug Reports](https://github.com/chaplean/zoho-invoice-client-bundle/issues): While we strive for quality software, bugs can happen and we can't fix issues we're not aware of. So please report even if you're not sure about it or just want to ask a question. If anything the issue might indicate that the documentation can still be improved!
* [Feature Request](https://github.com/chaplean/zoho-invoice-client-bundle/issues): You have a use case not covered by the current api? Want to suggest a change or add something? We'd be glad to read about it and start a discussion to try to find the best possible solution.
* [Pull Request](https://github.com/chaplean/zoho-invoice-client-bundle/pulls): Want to contribute code or documentation? We'd love that! If you need help to get started, GitHub as [documentation](https://help.github.com/articles/about-pull-requests/) on pull requests. We use the ["fork and pull model"](https://help.github.com/articles/about-collaborative-development-models/) were contributors push changes to their personnal fork and then create pull requests to the main repository. Please make your pull requests against the `master` branch.

As a reminder, all contributors are expected to follow our [Code of Conduct](CODE_OF_CONDUCT.md).

## Hacking

You might find the following commands usefull when hacking on this project:

```bash
# Install dependencies
composer install

# Run tests
bin/phpunit
```

## License

zoho-invoice-client-bundle is distributed under the terms of the MIT license.

See [LICENSE](LICENSE.md) for details.
