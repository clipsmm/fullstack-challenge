<?php

namespace App\Jobs;

use App\Events\UserWeatherUpdated;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FetchUserWeather implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    protected $cacheKey;

    /**
     * @var int
     */
    protected $cacheTtl;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, string $cacheKey, $cacheTtl = 3600)
    {
        $this->user = $user;
        $this->cacheKey = $cacheKey;
        $this->cacheTtl = $cacheTtl;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $weather = $this->fetchWeather();

        if($weather) {
            Cache::set($this->cacheKey, $weather, $this->cacheTtl);
            event(new UserWeatherUpdated($this->user, $weather));
        }
    }

    private function fetchWeather()
    {
        return Http::get('https://api.openweathermap.org/data/2.5/onecall', [
            'lat' => $this->user->latitude,
            'lon' => $this->user->longitude,
            'exclude' => 'minutely,hourly,daily',
            'appid' => config('services.weatherapi.app_id'),
        ])->json();
    }
}
