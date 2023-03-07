<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => "https://ui-avatars.com/api/?background=ee3469&color=FFF&name={$this->name}",
            'email' => $this->email,
            'weather' => WeatherForecastResource::make($this->getWeather()),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
