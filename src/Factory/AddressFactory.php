<?php

declare(strict_types=1);

namespace Smochin\OpenStreetMap\Factory;

use Smochin\OpenStreetMap\ValueObject\Address;
use Smochin\OpenStreetMap\ValueObject\Country;

class AddressFactory
{
    /**
     * @param string $city
     * @param string $state
     * @param string $country
     * @param string $country_code
     *
     * @return Address
     */
    public static function create(string $city, string $state, string $country, string $country_code): Address
    {
        return new Address($city, $state, new Country($country, $country_code));
    }
}
