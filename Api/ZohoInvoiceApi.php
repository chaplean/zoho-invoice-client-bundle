<?php

namespace Chaplean\Bundle\ZohoInvoiceClientBundle\Api;

use Chaplean\Bundle\RestClientBundle\Api\AbstractApi;
use Chaplean\Bundle\RestClientBundle\Api\Parameter;
use Chaplean\Bundle\RestClientBundle\Api\RequestRoute;
use Chaplean\Bundle\RestClientBundle\Api\Route;
use GuzzleHttp\ClientInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class ZohoInvoiceApi
 *
 * @method Route        getItems()
 * @method Route        getItem()
 * @method Route        getEstimate()
 * @method Route        getEstimates()
 * @method Route        getInvoice()
 * @method Route        getInvoices()
 *
 * @method RequestRoute postItem()
 * @method RequestRoute postItemActive()
 * @method RequestRoute postItemInactive()
 * @method RequestRoute postEstimate()
 * @method RequestRoute postInvoice()
 *
 * @method RequestRoute putItem()
 * @method RequestRoute putEstimate()
 * @method RequestRoute putInvoice()
 *
 * @method Route        deleteInvoice()
 * @method Route        deleteItem()
 * @method Route        deleteEstimate()
 *
 * @author    Hugo - Chaplean <hugo@chaplean.coop>
 * @copyright 2014 - 2017 Chaplean (http://www.chaplean.coop)
 * @since     1.0.0
 */
class ZohoInvoiceApi extends AbstractApi
{
    protected $token;

    protected $organizationId;

    protected $url;

    /**
     * ZohoInvoiceApi constructor.
     *
     * @param ClientInterface          $caller
     * @param EventDispatcherInterface $eventDispatcher
     * @param string                   $url
     * @param string|null              $accessToken
     * @param string|null              $organizationId
     */
    public function __construct(ClientInterface $caller, EventDispatcherInterface $eventDispatcher, $url, $accessToken = null, $organizationId = null)
    {
        $this->token = $accessToken;
        $this->organizationId = $organizationId;
        $this->url = $url;
        parent::__construct($caller, $eventDispatcher);
    }

    /**
     * Set api actions.
     *
     * @return void
     */
    public function buildApi()
    {
        $this->globalParameters()
            ->sendJSONString()
            ->urlPrefix($this->url)
            ->queryParameters(
                [
                    'authtoken'       => Parameter::string()
                        ->defaultValue($this->token),
                    'organization_id' => Parameter::string()
                        ->defaultValue($this->organizationId)
                ]
            );

        // Items
        $this->get('items', 'items')
            ->queryParameters(
                [
                    'authtoken'       => Parameter::string()
                        ->defaultValue($this->token),
                    'organization_id' => Parameter::string()
                        ->defaultValue($this->organizationId),
                    'name'        => Parameter::string()
                        ->optional(),
                    'rate'        => Parameter::float()
                        ->optional(),
                    'description' => Parameter::string()
                        ->optional(),
                    'tax_id '     => Parameter::id()
                        ->optional(),
                    'filter_by'   => Parameter::string()
                        ->optional(), //Allowed Values: Status.All, Status.Active and Status.Inactive
                    'search_text' => Parameter::string()
                        ->optional(),
                    'sort_column' => Parameter::string()
                        ->optional(), // Allowed Values: name, rate and tax_name
                ]
            );

        $this->get('item', 'items/{id}')
            ->urlParameters(
                [
                    'id' => Parameter::id()
                ]
            );

        $this->post('item', 'items')
            ->requestParameters(
                [
                    'name'              => Parameter::string(),
                    'rate'              => Parameter::float(),
                    'description'       => Parameter::string()
                        ->optional(),
                    'tax_id '           => Parameter::id()
                        ->optional(),
                    'sku'               => Parameter::string()
                        ->optional(),
                    'product_type '     => Parameter::string()
                        ->optional(),
                    'is_taxable '       => Parameter::bool()
                        ->optional(),
                    'tax_exemption_id ' => Parameter::id()
                        ->optional(),
                ]
            );

        $this->put('item', 'items/{id}')
            ->urlParameters(
                [
                    'id' => Parameter::id()
                ]
            )
            ->requestParameters(
                [
                    'name'              => Parameter::string(),
                    'rate'              => Parameter::float(),
                    'description'       => Parameter::string(),
                    'description'       => Parameter::string()
                        ->optional(),
                    'tax_id '           => Parameter::id()
                        ->optional(),
                    'sku'               => Parameter::string()
                        ->optional(),
                    'product_type '     => Parameter::string()
                        ->optional(),
                    'is_taxable '       => Parameter::bool()
                        ->optional(),
                    'tax_exemption_id ' => Parameter::id()
                        ->optional(),
                ]
            );

        $this->delete('item', 'items/{id}')
            ->urlParameters(
                [
                    'id' => Parameter::id()
                ]
            );

        $this->post('itemActive', 'items/{id}/active')
            ->urlParameters(
                [
                    'id' => Parameter::id()
                ]
            );

        $this->post('itemInactive', 'items/{id}/inactive')
            ->urlParameters(
                [
                    'id' => Parameter::id()
                ]
            );

        // Estimates
        $this->get('estimate', 'estimates/{id}')
            ->urlParameters(
                [
                    'id' => Parameter::id()
                ]
            )
            ->queryParameters(
                [
                    'authtoken'       => Parameter::string()
                        ->defaultValue($this->token),
                    'organization_id' => Parameter::string()
                        ->defaultValue($this->organizationId),
                    'print'  => Parameter::string()
                        ->optional(),
                    'accept' => Parameter::string()
                        ->optional(), //Allowed Values: json, pdf and html
                ]
            );

        $this->get('estimates', 'estimates')
            ->queryParameters(
                [
                    'authtoken'       => Parameter::string()
                        ->defaultValue($this->token),
                    'organization_id' => Parameter::string()
                        ->defaultValue($this->organizationId),
                    'estimate_number'  => Parameter::string()
                        ->optional(),
                    'reference_number' => Parameter::string()
                        ->optional(),
                    'customer_name'    => Parameter::string()
                        ->optional(),
                    'total'            => Parameter::float()
                        ->optional(),
                    'customer_id'      => Parameter::id()
                        ->optional(),
                    'item_id'          => Parameter::id()
                        ->optional(),
                    'item_name'        => Parameter::string()
                        ->optional(),
                    'item_description' => Parameter::string()
                        ->optional(),
                    'custom_field'     => Parameter::string()
                        ->optional(),
                    'expiry_date'      => Parameter::string()
                        ->optional(),
                    'date'             => Parameter::string()
                        ->optional(),
                    'status'           => Parameter::string()
                        ->optional(),
                    'filter_by'        => Parameter::string()
                        ->optional(), //Allowed Values Status.All, Status.Sent, Status.Draft, Status.Invoiced, Status.Accepted, Status.Declined and Status.Expired
                    'search_text'      => Parameter::string()
                        ->optional(),
                    'sort_column'      => Parameter::string()
                        ->optional(), //Allowed Values customer_name, estimate_number, date, total and created_time
                ]
            );

        $this->post('estimate', 'estimates')
            ->requestParameters(
                [
                    'customer_id'            => Parameter::id(),
                    'contact_persons'        => Parameter::arrayList(Parameter::id())
                        ->optional(),
                    'template_id'            => Parameter::id()
                        ->optional(),
                    'estimate_number'        => Parameter::string()
                        ->optional(),
                    'reference_number'       => Parameter::string()
                        ->optional(),
                    'date'                   => Parameter::string()
                        ->optional(),
                    'expiry_date'            => Parameter::string()
                        ->optional(),
                    'exchange_rate'          => Parameter::float()
                        ->optional(),
                    'discount'               => Parameter::float()
                        ->optional(),
                    'is_discount_before_tax' => Parameter::bool()
                        ->optional(),
                    'discount_type'          => Parameter::string()
                        ->optional(), // Allowed Values: entity_level and item_level
                    'is_inclusive_tax'       => Parameter::bool()
                        ->optional(),
                    'custom_body'            => Parameter::string()
                        ->optional(),
                    'custom_subject'         => Parameter::string()
                        ->optional(),
                    'salesperson_name'       => Parameter::string()
                        ->optional(),
                    'custom_fields'          => Parameter::arrayList(
                        Parameter::object(
                            [
                                'index' => Parameter::int()
                                    ->optional(),
                                'value' => Parameter::string()
                                    ->optional(),
                            ]
                        )
                    )
                        ->optional(),
                    'line_items'             => Parameter::arrayList(
                        Parameter::object(
                            [
                                'item_id'          => Parameter::id()
                                    ->optional(),
                                'line_item_id'     => Parameter::id()
                                    ->optional(),
                                'name'             => Parameter::string()
                                    ->optional(),
                                'description'      => Parameter::string()
                                    ->optional(),
                                'item_order'       => Parameter::int()
                                    ->optional(),
                                'rate'             => Parameter::float()
                                    ->optional(),
                                'quantity'         => Parameter::int()
                                    ->optional(),
                                'unit'             => Parameter::string()
                                    ->optional(),
                                'discount_amount'  => Parameter::float()
                                    ->optional(),
                                'discount'         => Parameter::float()
                                    ->optional(),
                                'tax_id'           => Parameter::id()
                                    ->optional(),
                                'tax_exemption_id' => Parameter::id()
                                    ->optional(),
                                'avatax_tax_code'  => Parameter::string()
                                    ->optional(),
                                'avatax_use_code'  => Parameter::string()
                                    ->optional(),
                                'tax_name'         => Parameter::string()
                                    ->optional(),
                                'tax_type'         => Parameter::string()
                                    ->optional(),
                                'tax_percentage'   => Parameter::float()
                                    ->optional(),
                                'item_total'       => Parameter::float()
                                    ->optional(),
                            ]
                        )
                    ),
                    'notes'                  => Parameter::string()
                        ->optional(),
                    'terms'                  => Parameter::string()
                        ->optional(),
                    'shipping_charge'        => Parameter::float()
                        ->optional(),
                    'adjustment'             => Parameter::float()
                        ->optional(),
                    'adjustment_description' => Parameter::string()
                        ->optional(),
                    'tax_id'                 => Parameter::id()
                        ->optional(),
                    'tax_exemption_id'       => Parameter::id()
                        ->optional(),
                    'tax_authority_id'       => Parameter::id()
                        ->optional(),
                    'avatax_use_code'        => Parameter::string()
                        ->optional(),
                    'avatax_tax_code'        => Parameter::string()
                        ->optional(),
                    'avatax_exempt_no'       => Parameter::string()
                        ->optional(),
                    'vat_treatment'          => Parameter::string()
                        ->optional(),
                ]
            )
            ->queryParameters(
                [
                    'authtoken'       => Parameter::string()
                        ->defaultValue($this->token),
                    'organization_id' => Parameter::string()
                        ->defaultValue($this->organizationId),
                    'send'                          => Parameter::string()
                        ->optional(),
                    'ignore_auto_number_generation' => Parameter::string()
                        ->optional(),
                ]
            );

        $this->put('estimate', 'estimates/{id}')
            ->urlParameters(
                [
                    'id' => Parameter::id()
                ]
            )
            ->requestParameters(
                [
                    'customer_id'            => Parameter::id(),
                    'contact_persons'        => Parameter::arrayList(Parameter::id())
                        ->optional(),
                    'template_id'            => Parameter::id()
                        ->optional(),
                    'estimate_number'        => Parameter::string()
                        ->optional(),
                    'reference_number'       => Parameter::string()
                        ->optional(),
                    'date'                   => Parameter::string()
                        ->optional(),
                    'expiry_date'            => Parameter::string()
                        ->optional(),
                    'exchange_rate'          => Parameter::float()
                        ->optional(),
                    'discount'               => Parameter::float()
                        ->optional(),
                    'is_discount_before_tax' => Parameter::bool()
                        ->optional(),
                    'discount_type'          => Parameter::string()
                        ->optional(), // Allowed Values: entity_level and item_level
                    'is_inclusive_tax'       => Parameter::bool()
                        ->optional(),
                    'custom_body'            => Parameter::string()
                        ->optional(),
                    'custom_subject'         => Parameter::string()
                        ->optional(),
                    'salesperson_name'       => Parameter::string()
                        ->optional(),
                    'custom_fields'          => Parameter::arrayList(
                        Parameter::object(
                            [
                                'index' => Parameter::int()
                                    ->optional(),
                                'value' => Parameter::string()
                                    ->optional(),
                            ]
                        )
                    ),
                    'line_items'             => Parameter::arrayList(
                        Parameter::object(
                            [
                                'item_id'          => Parameter::id()
                                    ->optional(),
                                'line_item_id'     => Parameter::id()
                                    ->optional(),
                                'name'             => Parameter::string()
                                    ->optional(),
                                'description'      => Parameter::string()
                                    ->optional(),
                                'item_order'       => Parameter::int()
                                    ->optional(),
                                'rate'             => Parameter::float()
                                    ->optional(),
                                'quantity'         => Parameter::int()
                                    ->optional(),
                                'unit'             => Parameter::string()
                                    ->optional(),
                                'discount_amount'  => Parameter::float()
                                    ->optional(),
                                'discount'         => Parameter::float()
                                    ->optional(),
                                'tax_id'           => Parameter::id()
                                    ->optional(),
                                'tax_exemption_id' => Parameter::id()
                                    ->optional(),
                                'avatax_tax_code'  => Parameter::string()
                                    ->optional(),
                                'avatax_use_code'  => Parameter::string()
                                    ->optional(),
                                'tax_name'         => Parameter::string()
                                    ->optional(),
                                'tax_type'         => Parameter::string()
                                    ->optional(),
                                'tax_percentage'   => Parameter::float()
                                    ->optional(),
                                'item_total'       => Parameter::float()
                                    ->optional(),
                            ]
                        )
                    )
                        ->optional(),
                    'notes'                  => Parameter::string()
                        ->optional(),
                    'terms'                  => Parameter::string()
                        ->optional(),
                    'shipping_charge'        => Parameter::float()
                        ->optional(),
                    'adjustment'             => Parameter::float()
                        ->optional(),
                    'adjustment_description' => Parameter::string()
                        ->optional(),
                    'tax_id'                 => Parameter::id()
                        ->optional(),
                    'tax_exemption_id'       => Parameter::id()
                        ->optional(),
                    'tax_authority_id'       => Parameter::id()
                        ->optional(),
                    'avatax_use_code'        => Parameter::string()
                        ->optional(),
                    'avatax_tax_code'        => Parameter::string()
                        ->optional(),
                    'avatax_exempt_no'       => Parameter::string()
                        ->optional(),
                    'vat_treatment'          => Parameter::string()
                        ->optional(),
                ]
            )
            ->queryParameters(
                [
                    'authtoken'       => Parameter::string()
                        ->defaultValue($this->token),
                    'organization_id' => Parameter::string()
                        ->defaultValue($this->organizationId),
                    'ignore_auto_number_generation' => Parameter::bool()
                        ->optional(),
                ]
            );

        $this->delete('estimate', 'estimates/{id}')
            ->urlParameters(
                [
                    'id' => Parameter::id()
                ]
            );

        // Invoices
        $this->get('invoice', 'invoices/{id}')
            ->urlParameters(
                [
                    'id' => Parameter::id()
                ]
            )
            ->queryParameters(
                [
                    'authtoken'       => Parameter::string()
                        ->defaultValue($this->token),
                    'organization_id' => Parameter::string()
                        ->defaultValue($this->organizationId),
                    'print'  => Parameter::string()
                        ->optional(),
                    'accept' => Parameter::string()
                        ->optional(), //Allowed Values: json, pdf and html
                ]
            );

        $this->get('invoices', 'invoices')
            ->queryParameters(
                [
                    'authtoken'       => Parameter::string()
                        ->defaultValue($this->token),
                    'organization_id' => Parameter::string()
                        ->defaultValue($this->organizationId),
                    'invoice_number'       => Parameter::string()
                        ->optional(),
                    'item_id'              => Parameter::id()
                        ->optional(),
                    'item_name'            => Parameter::string()
                        ->optional(),
                    'item_description'     => Parameter::string()
                        ->optional(),
                    'reference_number'     => Parameter::string()
                        ->optional(),
                    'customer_name'        => Parameter::string()
                        ->optional(),
                    'recurring_invoice_id' => Parameter::id()
                        ->optional(),
                    'email'                => Parameter::string()
                        ->optional(),
                    'total'                => Parameter::float()
                        ->optional(),
                    'balance'              => Parameter::float()
                        ->optional(),
                    'custom_field'         => Parameter::string()
                        ->optional(),
                    'date'                 => Parameter::string()
                        ->optional(),
                    'due_date'             => Parameter::string()
                        ->optional(),
                    'status'               => Parameter::string()
                        ->optional(),
                    //Allowed Values: sent, draft, overdue, paid, void, unpaid, partially_paid and viewed
                    'customer_id'          => Parameter::id()
                        ->optional(),
                    'filter_by'            => Parameter::string()
                        ->optional(),
                    //Allowed Values: Status.All, Status.Sent, Status.Draft, Status.OverDue, Status.Paid, Status.Void, Status.Unpaid, Status.PartiallyPaid, Status.Viewed and Date.PaymentExpectedDate
                    'search_text'          => Parameter::string()
                        ->optional(),
                    'sort_column'          => Parameter::string()
                        ->optional(),
                    //Allowed Values: customer_name, invoice_number, date, due_date, total, balance and created_time
                ]
            );

        $this->post('invoice', 'invoices')
            ->requestParameters(
                [
                    'customer_id'            => Parameter::id(),
                    'contact_persons'        => Parameter::arrayList(Parameter::id())
                        ->optional(),
                    'invoice_number'         => Parameter::string()
                        ->optional(),
                    'reference_number'       => Parameter::string()
                        ->optional(),
                    'template_id'            => Parameter::id()
                        ->optional(),
                    'date'                   => Parameter::string()
                        ->optional(),
                    'payment_terms'          => Parameter::string()
                        ->optional(),
                    'payment_terms_label'    => Parameter::string()
                        ->optional(),
                    'due_date'               => Parameter::string()
                        ->optional(),
                    'discount'               => Parameter::float()
                        ->optional(),
                    'is_discount_before_tax' => Parameter::bool()
                        ->optional(),
                    'discount_type'          => Parameter::string()
                        ->optional(), // Allowed Values: entity_level and item_level
                    'is_inclusive_tax'       => Parameter::bool()
                        ->optional(),
                    'exchange_rate'          => Parameter::float()
                        ->optional(),
                    'recurring_invoice_id'   => Parameter::id()
                        ->optional(),
                    'invoiced_estimate_id'   => Parameter::id()
                        ->optional(),
                    'salesperson_name'       => Parameter::string()
                        ->optional(),
                    'custom_fields'          => Parameter::arrayList(
                        Parameter::object(
                            [
                                'index'       => Parameter::int()
                                    ->optional(),
                                'show_on_pdf' => Parameter::bool()
                                    ->optional(),
                                'value'       => Parameter::string()
                                    ->optional(),
                                'label'       => Parameter::string()
                                    ->optional(),
                            ]
                        )
                    )
                        ->optional(),
                    'project_id'             => Parameter::id()
                        ->optional(),
                    'line_items'             => Parameter::arrayList(
                        Parameter::object(
                            [
                                'item_id'          => Parameter::id()
                                    ->optional(),
                                'line_item_id'     => Parameter::id()
                                    ->optional(),
                                'project_id'       => Parameter::id()
                                    ->optional(),
                                'time_entry_ids'   => Parameter::id()
                                    ->optional(),
                                'expense_id'       => Parameter::id()
                                    ->optional(),
                                'name'             => Parameter::string()
                                    ->optional(),
                                'description'      => Parameter::string()
                                    ->optional(),
                                'item_order'       => Parameter::int()
                                    ->optional(),
                                'rate'             => Parameter::float()
                                    ->optional(),
                                'quantity'         => Parameter::int()
                                    ->optional(),
                                'unit'             => Parameter::string()
                                    ->optional(),
                                'discount_amount'  => Parameter::float()
                                    ->optional(),
                                'discount'         => Parameter::float()
                                    ->optional(),
                                'tax_id'           => Parameter::id()
                                    ->optional(),
                                'tax_exemption_id' => Parameter::id()
                                    ->optional(),
                                'avatax_use_code'  => Parameter::string()
                                    ->optional(),
                                'avatax_exempt_no' => Parameter::string()
                                    ->optional(),
                                'tax_name'         => Parameter::string()
                                    ->optional(),
                                'tax_type'         => Parameter::string()
                                    ->optional(),
                                'tax_percentage'   => Parameter::float()
                                    ->optional(),
                                'item_total'       => Parameter::float()
                                    ->optional(),
                            ]
                        )
                    ),
                    'payment_options'        => Parameter::arrayList(
                        Parameter::object(
                            [
                                'payment_gateways' => Parameter::arrayList(
                                    Parameter::object(
                                        [
                                            'configured'        => Parameter::bool()
                                                ->optional(),
                                            'additional_field1' => Parameter::string()
                                                ->optional(), //Allowed Values: standard and adaptive
                                            'gateway_name'      => Parameter::string()
                                                ->optional(), //Allowed Values: paypal, authorize_net, payflow_pro, stripe, 2checkout and braintree
                                        ]
                                    )
                                )
                                    ->optional(),
                            ]
                        )
                    )
                        ->optional(),
                    'allow_partial_payments' => Parameter::bool()
                        ->optional(),
                    'custom_body'            => Parameter::string()
                        ->optional(),
                    'custom_subject'         => Parameter::string()
                        ->optional(),
                    'notes'                  => Parameter::string()
                        ->optional(),
                    'terms'                  => Parameter::string()
                        ->optional(),
                    'shipping_charge'        => Parameter::float()
                        ->optional(),
                    'adjustment'             => Parameter::float()
                        ->optional(),
                    'adjustment_description' => Parameter::string()
                        ->optional(),
                    'reason'                 => Parameter::string()
                        ->optional(),
                    'tax_exemption_id'       => Parameter::id()
                        ->optional(),
                    'tax_authority_id'       => Parameter::id()
                        ->optional(),
                    'avatax_use_code'        => Parameter::string()
                        ->optional(),
                    'avatax_tax_code'        => Parameter::string()
                        ->optional(),
                    'avatax_exempt_no'       => Parameter::string()
                        ->optional(),
                    'vat_treatment'          => Parameter::string()
                        ->optional(),
                ]
            )
            ->queryParameters(
                [
                    'authtoken'       => Parameter::string()
                        ->defaultValue($this->token),
                    'organization_id' => Parameter::string()
                        ->defaultValue($this->organizationId),
                    'send'                          => Parameter::string()
                        ->optional(),
                    'ignore_auto_number_generation' => Parameter::string()
                        ->optional(),
                ]
            );

        $this->put('invoice', 'invoices/{id}')
            ->urlParameters(
                [
                    'id' => Parameter::id()
                ]
            )
            ->requestParameters(
                [
                    'customer_id'            => Parameter::id(),
                    'contact_persons'        => Parameter::arrayList(Parameter::id())
                        ->optional(),
                    'invoice_number'         => Parameter::string()
                        ->optional(),
                    'reference_number'       => Parameter::string()
                        ->optional(),
                    'template_id'            => Parameter::id()
                        ->optional(),
                    'date'                   => Parameter::string()
                        ->optional(),
                    'payment_terms'          => Parameter::string()
                        ->optional(),
                    'payment_terms_label'    => Parameter::string()
                        ->optional(),
                    'due_date'               => Parameter::string()
                        ->optional(),
                    'discount'               => Parameter::float()
                        ->optional(),
                    'is_discount_before_tax' => Parameter::bool()
                        ->optional(),
                    'discount_type'          => Parameter::string()
                        ->optional(), // Allowed Values: entity_level and item_level
                    'is_inclusive_tax'       => Parameter::bool()
                        ->optional(),
                    'exchange_rate'          => Parameter::float()
                        ->optional(),
                    'recurring_invoice_id'   => Parameter::id()
                        ->optional(),
                    'invoiced_estimate_id'   => Parameter::id()
                        ->optional(),
                    'salesperson_name'       => Parameter::string()
                        ->optional(),
                    'custom_fields'          => Parameter::arrayList(
                        Parameter::object(
                            [
                                'index'       => Parameter::int()
                                    ->optional(),
                                'show_on_pdf' => Parameter::bool()
                                    ->optional(),
                                'value'       => Parameter::string()
                                    ->optional(),
                                'label'       => Parameter::string()
                                    ->optional(),
                            ]
                        )
                    )
                        ->optional(),
                    'project_id'             => Parameter::id()
                        ->optional(),
                    'line_items'             => Parameter::arrayList(
                        Parameter::object(
                            [
                                'item_id'          => Parameter::id()
                                    ->optional(),
                                'line_item_id'     => Parameter::id()
                                    ->optional(),
                                'project_id'       => Parameter::id()
                                    ->optional(),
                                'time_entry_ids'   => Parameter::id()
                                    ->optional(),
                                'expense_id'       => Parameter::id()
                                    ->optional(),
                                'name'             => Parameter::string()
                                    ->optional(),
                                'description'      => Parameter::string()
                                    ->optional(),
                                'item_order'       => Parameter::int()
                                    ->optional(),
                                'rate'             => Parameter::float()
                                    ->optional(),
                                'quantity'         => Parameter::int()
                                    ->optional(),
                                'unit'             => Parameter::string()
                                    ->optional(),
                                'discount_amount'  => Parameter::float()
                                    ->optional(),
                                'discount'         => Parameter::float()
                                    ->optional(),
                                'tax_id'           => Parameter::id()
                                    ->optional(),
                                'tax_exemption_id' => Parameter::id()
                                    ->optional(),
                                'avatax_use_code'  => Parameter::string()
                                    ->optional(),
                                'avatax_exempt_no' => Parameter::string()
                                    ->optional(),
                                'tax_name'         => Parameter::string()
                                    ->optional(),
                                'tax_type'         => Parameter::string()
                                    ->optional(),
                                'tax_percentage'   => Parameter::float()
                                    ->optional(),
                                'item_total'       => Parameter::float()
                                    ->optional(),
                            ]
                        )
                    ),
                    'payment_options'        => Parameter::arrayList(
                        Parameter::object(
                            [
                                'payment_gateways' => Parameter::arrayList(
                                    Parameter::object(
                                        [
                                            'configured'        => Parameter::bool()
                                                ->optional(),
                                            'additional_field1' => Parameter::string()
                                                ->optional(), //Allowed Values: standard and adaptive
                                            'gateway_name'      => Parameter::string()
                                                ->optional(), //Allowed Values: paypal, authorize_net, payflow_pro, stripe, 2checkout and braintree
                                        ]
                                    )
                                )
                                    ->optional(),
                            ]
                        )
                    )
                        ->optional(),
                    'allow_partial_payments' => Parameter::bool()
                        ->optional(),
                    'custom_body'            => Parameter::string()
                        ->optional(),
                    'custom_subject'         => Parameter::string()
                        ->optional(),
                    'notes'                  => Parameter::string()
                        ->optional(),
                    'terms'                  => Parameter::string()
                        ->optional(),
                    'shipping_charge'        => Parameter::float()
                        ->optional(),
                    'adjustment'             => Parameter::float()
                        ->optional(),
                    'adjustment_description' => Parameter::string()
                        ->optional(),
                    'reason'                 => Parameter::string()
                        ->optional(),
                    'tax_exemption_id'       => Parameter::id()
                        ->optional(),
                    'tax_authority_id'       => Parameter::id()
                        ->optional(),
                    'avatax_use_code'        => Parameter::string()
                        ->optional(),
                    'avatax_tax_code'        => Parameter::string()
                        ->optional(),
                    'avatax_exempt_no'       => Parameter::string()
                        ->optional(),
                    'vat_treatment'          => Parameter::string()
                        ->optional(),
                ]
            )
            ->queryParameters(
                [
                    'authtoken'       => Parameter::string()
                        ->defaultValue($this->token),
                    'organization_id' => Parameter::string()
                        ->defaultValue($this->organizationId),
                    'ignore_auto_number_generation' => Parameter::string()
                        ->optional(),
                ]
            );

        $this->delete('invoice', 'invoices/{id}')
            ->urlParameters(
                [
                    'id' => Parameter::id()
                ]
            );
    }
}
