<?php

declare(strict_types=1);

namespace Smochin\OpenStreetMap\ValueObject;

class Address
{
    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var Country
     */
    private $country;

    /**
     * @param string  $city
     * @param string  $state
     * @param Country $country
     */
    public function __construct(string $city, string $state, Country $country)
    {
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }
}
