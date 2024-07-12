@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>Weather Forecast for {{ $weather['name'] }}</h1>
        <p>{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</p>
    </div>
    <div class="card-body">
        <p class="card-text"><strong>Temperature:</strong> {{ $weather['main']['temp'] }} °C</p>
        <p class="card-text"><strong>Feels Like:</strong> {{ $weather['main']['feels_like'] }} °C</p>
        <p class="card-text"><strong>Humidity:</strong> {{ $weather['main']['humidity'] }}%</p>
        <p class="card-text"><strong>Wind Speed:</strong> {{ $weather['wind']['speed'] }} m/s</p>
        <p class="card-text"><strong>Description:</strong> {{ $weather['weather'][0]['description'] }}
            <img src="http://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@2x.png" alt="weather icon">
        </p>
    </div>
</div>

<div class="mt-5">
    <h2>5-day Forecast</h2>
    <div class="row">
        @foreach($forecast['list'] as $day)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ \Carbon\Carbon::createFromTimestamp($day['dt'])->format('l, M d H:i') }}</h5>
                        <p class="card-text"><strong>Temp:</strong> {{ $day['main']['temp'] }} °C</p>
                        <p class="card-text"><strong>Description:</strong> {{ $day['weather'][0]['description'] }}
                            <img src="http://openweathermap.org/img/wn/{{ $day['weather'][0]['icon'] }}@2x.png" alt="weather icon">
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
