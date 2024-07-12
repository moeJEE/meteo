<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    protected $apiKey;
    protected $currentWeatherUrl;
    protected $forecastUrl;

    public function __construct()
    {
        $this->apiKey = env('OPENWEATHERMAP_API_KEY');
        $this->currentWeatherUrl = 'https://api.openweathermap.org/data/2.5/weather';
        $this->forecastUrl = 'https://api.openweathermap.org/data/2.5/forecast';
    }

    public function index()
    {
        $city = 'Casablanca'; // or get it dynamically from user input
        $weather = $this->getCurrentWeather($city);
        $forecast = $this->getForecast($city);

        if (isset($weather['cod']) && $weather['cod'] != 200) {
            return view('weather.error', ['message' => $weather['message'] ?? 'An error occurred']);
        }

        if (isset($forecast['cod']) && $forecast['cod'] != '200') {
            return view('weather.error', ['message' => $forecast['message'] ?? 'An error occurred']);
        }

        return view('weather.index', compact('weather', 'forecast'));
    }

    public function getCurrentWeather($city)
    {
        $response = Http::get($this->currentWeatherUrl, [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric'
        ]);

        return $response->json();
    }

    public function getForecast($city)
    {
        $response = Http::get($this->forecastUrl, [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric'
        ]);

        return $response->json();
    }
}
