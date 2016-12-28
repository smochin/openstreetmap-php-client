<?php

declare(strict_types=1);

namespace Smochin\OpenStreetMap;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use Smochin\OpenStreetMap\Exception\UnableToGeocodeException;
use Smochin\OpenStreetMap\Factory\AddressFactory;
use Smochin\OpenStreetMap\ValueObject\Address;

class Client
{
    const BASE_URI = 'http://nominatim.openstreetmap.org';
    const REVERSE_ENDPOINT = '/reverse';

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct()
    {
        $this->client = new HttpClient([
            'base_uri' => self::BASE_URI,
        ]);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     *
     * @return Address
     *
     * @throws GuzzleException
     * @throws UnableToGeocodeException
     */
    public function reverse(float $latitude, float $longitude): Address
    {
        $response = $this->client->request('GET', self::REVERSE_ENDPOINT, [
            'query' => ['lat' => $latitude, 'lon' => $longitude],
        ]);
        $body = simplexml_load_string($response->getBody()->getContents());
        if (property_exists($body, 'error')) {
            throw new UnableToGeocodeException((string) $body->error);
        }

        return AddressFactory::create(
            (string) $body->addressparts->city,
            (string) $body->addressparts->state,
            (string) $body->addressparts->country,
            (string) $body->addressparts->country_code
        );
    }

    /**
     * @param float $latitude
     * @param float $longitude
     *
     * @return PromiseInterface
     */
    public function reverseAsync(float $latitude, float $longitude): PromiseInterface
    {
        return $this->client->requestAsync('GET', self::REVERSE_ENDPOINT, [
            'query' => ['lat' => $latitude, 'lon' => $longitude],
        ]);
    }
}
