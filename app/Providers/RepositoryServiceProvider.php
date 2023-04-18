<?php

namespace App\Providers;

use App\Repositories\BannerRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryReponsitory;
use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\Contracts\CategoryReponsitoryInterface;
use App\Repositories\Contracts\ProductReponsitoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\ProductReponsitory;
use App\Repositories\UserRepository;
use App\Services\CategoryService;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->bind(ProductReponsitoryInterface::class, ProductReponsitory::class);
        $this->app->bind(CategoryReponsitoryInterface::class, CategoryReponsitory::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
    }
}
