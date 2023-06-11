<?php

namespace app\Controllers;

use app\Services\GeolocateService;

class GetLocationController
{
    public function searchByAddress($search)
    {
        return json_encode(
            (new GeolocateService())->SearchByAddress($search)
        );
    }
}