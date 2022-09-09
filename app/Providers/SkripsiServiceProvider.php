<?php

namespace App\Providers;

use App\Services\Impl\SkripsiServiceImpl;
use App\Services\SkripsiService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class SkripsiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        SkripsiService::class => SkripsiServiceImpl::class
    ];

    public function provides(): array
    {
        return [SkripsiService::class];
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
