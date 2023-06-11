<?php

namespace app\Services;

use app\Repositories\GeolocationRepository;

class GeolocateService
{
    public function SearchByAddress($address): array
    {
        $geolocationRepository = new GeolocationRepository($address);

        return $geolocationRepository->getCoordinates();
    }
}