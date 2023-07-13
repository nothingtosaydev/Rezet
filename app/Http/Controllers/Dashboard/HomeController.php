<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Resources\UserResource;
use App\Services\WeatherServiceInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @param  \App\Services\WeatherServiceInterface  $weatherService
     */
    public function __construct(
        protected WeatherServiceInterface $weatherService
    ) {
        $this->middleware('auth');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Controllers\Dashboard\Resources\UserResource
     */
    public function index(Request $request): UserResource
    {
        $weather = $this->weatherService->getDataFromApi($request); //transactions?

        return (new UserResource($request->user()))->additional([
            'meta' => [
                'temp' => $weather->main->temp,
                'pressure' => $weather->main->pressure,
                'humidity' => $weather->main->humidity,
                'temp_min' => $weather->main->temp_min,
                'temp_max' => $weather->main->temp_max,
            ]
        ]);
    }
}
