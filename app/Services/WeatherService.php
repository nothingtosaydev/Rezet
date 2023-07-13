<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;

class WeatherService implements WeatherServiceInterface
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return object
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getDataFromApi(Request $request): object
    {
        $redis = Cache::store('redis'); // DJ/DI

        $weather = $redis->get('user:weather:'.$request->user()->id, null);

        if (!$weather) {
            $location = Location::get('5.248.140.178'); //$request->id()

            $api = env('WEATHER_API');

            $weather = Http::get("https://api.openweathermap.org/data/2.5/weather?lat=$location->latitude&lon=$location->longitude&appid=$api")
                ->object();

            $redis->set('user:weather:'.$request->user()->id, $weather);
        }

        return $weather;
    }
}
