<?php

namespace App\Apis\Georef;

class GeoAddressApi extends GeoApi
{
    protected const ENDPOINT = 'direcciones';
    protected const MODEL = 'addresses';
    protected $addresses;
}
