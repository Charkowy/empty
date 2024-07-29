<?php

namespace App\Apis\Georef;

class GeoStateApi extends GeoApi
{
    protected const ENDPOINT = 'provincias';
    protected const MODEL = 'states';
    protected $states;
}
