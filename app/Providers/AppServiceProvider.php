<?php

namespace App\Providers;

use App\Services\BannerService;
use App\Services\BrandService;
use App\Services\Contracts\BannerServiceInterface;
use App\Services\Contracts\BrandServiceInterface;
use App\Services\Contracts\ImageServiceInterface;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\ImageService;
use App\Services\OrderService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(BannerServiceInterface::class, BannerService::class);
        $this->app->bind(BrandServiceInterface::class, BrandService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
        $this->app->bind(ImageServiceInterface::class, ImageService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
