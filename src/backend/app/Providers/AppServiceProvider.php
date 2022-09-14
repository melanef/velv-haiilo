<?php

namespace App\Providers;

use App\Mappers\EmailMapper;
use App\Mappers\FilterMapper;
use App\Mappers\JsonEmailMapper;
use App\Mappers\JsonFilterMapper;
use App\Repositories\EmailRepository;
use App\Repositories\FilterRepository;
use App\Repositories\JsonEmailRepository;
use App\Repositories\JsonFilterRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(EmailMapper::class, JsonEmailMapper::class);
        $this->app->bind(FilterMapper::class, JsonFilterMapper::class);
        $this->app->bind(EmailRepository::class, JsonEmailRepository::class);
        $this->app->bind(FilterRepository::class, JsonFilterRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
