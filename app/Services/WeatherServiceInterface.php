<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;

interface WeatherServiceInterface
{
    public function getDataFromApi(Request $request): object;
}
