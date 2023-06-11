<?php

namespace app\Integrations;

use app\IAddressCoordinates;

class OpenStreetMapsAPI extends MapsAPI implements IAddressCoordinates
{
    public function getCoordinates(): array
    {
        return [
            'lat' => 12.3456789,
            'lng' => 09.7654321
        ];
    }

    public function generateSearchAddressUrl()
    {
        return config('open_street_maps_url');
    }
}