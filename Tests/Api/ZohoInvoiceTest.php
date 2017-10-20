<?php

namespace  Chaplean\Bundle\ZohoInvoiceClientBundle\Tests\Api;

use Chaplean\Bundle\ZohoInvoiceClientBundle\Api\ZohoInvoiceApi;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use Symfony\Component\EventDispatcher\EventDispatcher;
/**
 * ZohoInvoiceTest.php.
 *
 * @author    Hugo - Chaplean <hugo@chaplean.coop>
 * @copyright 2014 - 2017 Chaplean (http://www.chaplean.coop)
 * @since     1.0.0
 */
class ZohoInvoiceTest extends TestCase
{
    /**
     * @var ZohoInvoiceApi
     */
    private $api;

    /**
     * @var array
     */
    private $routes;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->api = new ZohoInvoiceApi(new Client(), new EventDispatcher(), 'http://test.com');
        $reflector = new \ReflectionClass(ZohoInvoiceApi::class);
        $property = $reflector->getProperty('routes');
        $property->setAccessible(true);
        $this->routes = $property->getValue($this->api);
    }

    /**
     * @covers  \Chaplean\Bundle\ZohoInvoiceClientBundle\Api\ZohoInvoiceApi::__construct()
     *
     * @return void
     */
    public function testConstruct()
    {
        $api = new ZohoInvoiceApi(new Client(), new EventDispatcher(), 'http://test.com');
        $this->assertInstanceOf(ZohoInvoiceApi::class, $api);
    }

    /**
     * @covers \Chaplean\Bundle\ZohoInvoiceClientBundle\Api\ZohoInvoiceApi::buildApi()
     *
     * @return void
     */
    public function testGetRoutes()
    {
        $methods = ['invoices','invoice', 'estimates', 'estimate', 'items', 'item'];

        $this->assertArrayHasKey('get', $this->routes);
        $this->assertCount(6, $this->routes['get']);
        foreach ($methods as $method) {
            $this->assertArrayHasKey($method, $this->routes['get']);
        }
    }

    /**
     * @covers \Chaplean\Bundle\ZohoInvoiceClientBundle\Api\ZohoInvoiceApi::buildApi()
     *
     * @return void
     */
    public function testPostRoutes()
    {
        $methods = ['item','itemActive', 'itemInactive', 'estimate', 'invoice'];

        $this->assertArrayHasKey('post', $this->routes);
        $this->assertCount(5, $this->routes['post']);
        foreach ($methods as $method) {
            $this->assertArrayHasKey(strtolower($method), $this->routes['post']);
        }
    }

    /**
     * @covers \Chaplean\Bundle\ZohoInvoiceClientBundle\Api\ZohoInvoiceApi::buildApi()
     *
     * @return void
     */
    public function testPutRoutes()
    {
        $methods = ['item', 'estimate', 'invoice'];

        $this->assertArrayHasKey('put', $this->routes);
        $this->assertCount(3, $this->routes['put']);
        foreach ($methods as $method) {
            $this->assertArrayHasKey($method, $this->routes['put']);
        }
    }

    /**
     * @covers \Chaplean\Bundle\ZohoInvoiceClientBundle\Api\ZohoInvoiceApi::buildApi()
     *
     * @return void
     */
    public function testDeleteRoutes()
    {
        $methods = ['item', 'estimate', 'invoice'];

        $this->assertArrayHasKey('delete', $this->routes);
        $this->assertCount(3, $this->routes['delete']);
        foreach ($methods as $method) {
            $this->assertArrayHasKey($method, $this->routes['delete']);
        }
    }
}
