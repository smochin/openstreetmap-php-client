<?php

declare(strict_types=1);

namespace Smochin\OpenStreetMap;

use Smochin\OpenStreetMap\ValueObject\Address;
use GuzzleHttp\Promise\PromiseInterface;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    private $client;

    protected function setUp()
    {
        $this->client = new Client();
    }

    public function testReverse()
    {
        $address = $this->client->reverse(-8.047562, -34.876964);
        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals('Recife', $address->getCity());
        $this->assertEquals('PE', $address->getState());
        $this->assertEquals('Brasil', $address->getCountry()->getName());
    }

    /**
     * @expectedException \Smochin\OpenStreetMap\Exception\UnableToGeocodeException
     */
    public function testUnableToGeocodeException()
    {
        $this->client->reverse(0.5, 0.5);
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testGuzzleException()
    {
        $this->client->reverse(66666666666666666, 666666666666666666);
    }

    public function testReverseAsync()
    {
        $promise = $this->client->reverseAsync(-8.047562, -34.876964);
        $this->assertInstanceOf(PromiseInterface::class, $promise);
    }
}
