<?php

namespace app\Integrations;

abstract class MapsAPI
{
    protected $searchAddress;

    public function __construct($address)
    {
        $this->searchAddress = $address;
    }

    public function searchLocationByAddress()
    {
        return json_decode(
            file_get_contents($this->generateSearchAddressUrl())
        );
    }

    abstract function generateSearchAddressUrl();
}