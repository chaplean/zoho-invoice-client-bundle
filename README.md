# ChapleanZohoInvoiceClientBundle

![Codeship Status for chaplean/zoho-invoice-client-bundle](https://app.codeship.com/projects/4e1c9860-8729-0135-dfbb-66311f7cf82a/status?branch=master)

# Prerequisites

This version of the bundle requires Symfony 2.8+.

# Installation

## 1. Composer

```bash
composer require chaplean/zoho-invoice-client-bundle
```


## 2. AppKernel.php

Add
```php
new Chaplean\Bundle\ZohoInvoiceClientBundle\ChapleanZohoInvoiceClientBundle(),
```


# Configuration

## 1. config.yml 
```yml
imports:
    - { resource: '@ChapleanZohoInvoiceClientBundle/Resources/config/config.yml' }
```

## 2. paramters.yml
```yml
chaplean_zoho_invoice.access_token: 'your access token'
chaplean_zoho_invoice.organization_id: 'your organization id'
```

# Available functions:
* Items
    * getItems()
    * getItem()
    * postItem()
    * putItem()
    * deleteItem()
    * postItemActive()
    * postItemInactive()

* Estimate
    * getEstimate()
    * getEstimates()
    * postEstimate()
    * putEstimate()
    * deleteEstimate()

* Invoice
    * getInvoice()
    * getInvoices()
    * postInvoice()
    * putInvoice()
    * deleteInvoice()
