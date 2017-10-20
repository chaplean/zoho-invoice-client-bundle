<?php

namespace Tests\Chaplean\Bundle\ZohoInvoiceClientBundle\DependencyInjection;

use Chaplean\Bundle\ZohoInvoiceClientBundle\DependencyInjection\ChapleanZohoInvoiceClientExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ConfigurationTest.
 *
 * @package   Tests\Chaplean\Bundle\ZohoInvoiceClientBundle\DependencyInjection
 * @author    Matthias - Chaplean <matthias@chaplean.coop>
 * @copyright 2014 - 2017 Chaplean (http://www.chaplean.coop)
 * @since     1.0.0
 */
class ConfigurationTest extends TestCase
{
    /**
     * @covers \Chaplean\Bundle\ZohoInvoiceClientBundle\DependencyInjection\Configuration::getConfigTreeBuilder()
     * @covers \Chaplean\Bundle\ZohoInvoiceClientBundle\DependencyInjection\Configuration::addApiConfiguration()
     *
     * @return void
     */
    public function testFullyDefinedConfig()
    {
        $container = new ContainerBuilder();
        $loader = new ChapleanZohoInvoiceClientExtension();
        $loader->load([['api' => ['url' => 'url', 'access_token' => 'token', 'organization_id' => 42]]], $container);

        $this->assertEquals('url', $container->getParameter('chaplean_zoho_invoice_client.api.url'));
        $this->assertEquals('token', $container->getParameter('chaplean_zoho_invoice_client.api.access_token'));
        $this->assertEquals(42, $container->getParameter('chaplean_zoho_invoice_client.api.organization_id'));
    }

    /**
     * @covers \Chaplean\Bundle\ZohoInvoiceClientBundle\DependencyInjection\Configuration::getConfigTreeBuilder()
     * @covers \Chaplean\Bundle\ZohoInvoiceClientBundle\DependencyInjection\Configuration::addApiConfiguration()
     *
     * @return void
     */
    public function testDefaultConfig()
    {
        $container = new ContainerBuilder();
        $loader = new ChapleanZohoInvoiceClientExtension();
        $loader->load([[]], $container);

        $this->assertEquals('https://invoice.zoho.com/api/v3/', $container->getParameter('chaplean_zoho_invoice_client.api.url'));
        $this->assertEquals('%chaplean_zoho_invoice.access_token%', $container->getParameter('chaplean_zoho_invoice_client.api.access_token'));
        $this->assertEquals('%chaplean_zoho_invoice.organization_id%', $container->getParameter('chaplean_zoho_invoice_client.api.organization_id'));
    }
}
