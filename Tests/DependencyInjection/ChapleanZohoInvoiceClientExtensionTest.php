<?php

namespace Tests\Chaplean\Bundle\ZohoInvoiceClientBundle\DependencyInjection;

use Chaplean\Bundle\ZohoInvoiceClientBundle\DependencyInjection\ChapleanZohoInvoiceClientExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ChapleanZohoInvoiceClientExtensionTest.
 *
 * @package   Tests\Chaplean\Bundle\ZohoInvoiceClientBundle\DependencyInjection
 * @author    Matthias - Chaplean <matthias@chaplean.coop>
 * @copyright 2014 - 2017 Chaplean (http://www.chaplean.coop)
 * @since     1.0.0
 */
class ChapleanZohoInvoiceClientExtensionTest extends TestCase
{
    /**
     * @covers \Chaplean\Bundle\ZohoInvoiceClientBundle\DependencyInjection\ChapleanZohoInvoiceClientExtension::load()
     * @covers \Chaplean\Bundle\ZohoInvoiceClientBundle\DependencyInjection\ChapleanZohoInvoiceClientExtension::setParameters()
     *
     * @return void
     */
    public function testConfigIsLoadedInParameters()
    {
        $container = new ContainerBuilder();
        $loader = new ChapleanZohoInvoiceClientExtension();
        $loader->load([['api' => ['url' => 'url', 'access_token' => 'token', 'organization_id' => 42]]], $container);

        $this->assertEquals('url', $container->getParameter('chaplean_zoho_invoice_client.api.url'));
        $this->assertEquals('token', $container->getParameter('chaplean_zoho_invoice_client.api.access_token'));
        $this->assertEquals(42, $container->getParameter('chaplean_zoho_invoice_client.api.organization_id'));
    }
}
