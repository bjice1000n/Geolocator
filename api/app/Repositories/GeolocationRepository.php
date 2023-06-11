<?php

namespace app\Repositories;

use app\IAddressCoordinates;
use app\Integrations\GoogleMapsAPI;

class GeolocationRepository implements IAddressCoordinates
{
    private $mapIntegration;
    public function __construct($address)
    {
        $this->mapIntegration = new GoogleMapsAPI($address);
    }
    public function getCoordinates(): array
    {
        return $this->mapIntegration->getCoordinates();
    }
}