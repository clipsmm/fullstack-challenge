<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class WeatherForecastResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'main' => Arr::get($this, 'current.weather.0.main'),
            'description' => Arr::get($this, 'current.weather.0.description'),
            'icon' => "http://openweathermap.org/img/wn/".Arr::get($this, 'current.weather.0.icon')."@2x.png",
            'temp' => Arr::get($this, 'current.temp'),
            'windSpeed' => Arr::get($this, 'current.wind_speed'),
            'humidity' => Arr::get($this, 'current.humidity'),
            'pressure' => Arr::get($this, 'current.pressure'),
            'visibility' => Arr::get($this, 'current.visibility'),
            'sunrise' => Arr::get($this, 'current.sunrise'),
            'sunset' => Arr::get($this, 'current.sunset'),
            'rain' => Arr::get($this, 'current.rain.1h', 0),
        ];
    }
}
