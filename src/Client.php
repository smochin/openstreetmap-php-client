<?php

declare(strict_types=1);

namespace Smochin\OpenStreetMap;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Smochin\OpenStreetMap\Exception\UnableToGeocodeException;
use Smochin\OpenStreetMap\ValueObject\Address;
use Smochin\OpenStreetMap\ValueObject\Country;

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
        $this->client = new HttpClient(['base_uri' => self::BASE_URI]);
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
            'query' => [
                'lat' => $latitude,
                'lon' => $longitude,
                'format' => 'json',
                'zoom' => 18,
                'addressdetails' => 1,
            ],
        ]);
        $body = json_decode($response->getBody()->getContents(), true);
        if (array_key_exists('error', $body)) {
            throw new UnableToGeocodeException($body['error']);
        }

        return $this->loadAddress($body['address']);
    }

    /**
     * @param array $address
     *
     * @return Address
     */
    public function loadAddress(array $address): Address
    {
        return new Address(
            $address['city'],
            $address['state'],
            new Country($address['country'], $address['country_code'])
        );
    }
}
