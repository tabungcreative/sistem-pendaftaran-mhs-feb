<?php

namespace App\Providers;

use App\Services\Impl\TahunAjaranServiceImpl;
use App\Services\TahunAjaranService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TahunAjaranProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        TahunAjaranService::class => TahunAjaranServiceImpl::class
    ];

    public function provides(): array
    {
        return [TahunAjaranService::class];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
