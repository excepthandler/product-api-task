<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testGetProductsReturnsCorrectData(): void
    {
        $this->client->request('GET', '/products');

        $this->assertResponseIsSuccessful();
        $this->assertJson($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertCount(5, $response);
    }

    public function testGetProductsWithFilter(): void
    {
        $this->client->request('GET', '/products?category=boots');

        $this->assertResponseIsSuccessful();
        $this->assertJson($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertCount(3, $response);
        $this->assertEquals('000001', $response[0]['sku']);
        $this->assertEquals('000002', $response[1]['sku']);
        $this->assertEquals('000003', $response[2]['sku']);
    }
}