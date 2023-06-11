<?php

namespace app\Integrations;

use app\IAddressCoordinates;

class GoogleMapsAPI extends MapsAPI implements IAddressCoordinates
{
    public function getCoordinates(): array
    {
        $data = $this->searchLocationByAddress();

        if ($data->status == 'ZERO_RESULTS' || isset($data->error_message)) {
            return [];
        }

        return json_decode(json_encode($data->results[0]->geometry->location), true);
    }

    public function prepareAddressForSearch()
    {
        return preg_replace('/\s/', '+', $this->searchAddress);

    }

    public function generateSearchAddressUrl()
    {
        $search = $this->prepareAddressForSearch();

        return config('google_maps_api_url') . 'geocode/json?address=' . $search . '&key=' . config('google_maps_api_key');
    }
}