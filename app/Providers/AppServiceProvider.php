<?php

namespace App\Providers;

use App\Repositories\Auth\AuthInterface;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Brand\BrandInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Coupon\CouponInterface;
use App\Repositories\Coupon\CouponRepository;
use App\Repositories\MultiImg\MultiImgInterface;
use App\Repositories\MultiImg\MultiImgRepository;
use App\Repositories\Order\OrderInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\ProductRepository;
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
        $this->app->singleton(BrandInterface::class, BrandRepository::class);
        $this->app->singleton(CouponInterface::class, CouponRepository::class);
        $this->app->singleton(CategoryInterface::class, CategoryRepository::class);
        $this->app->singleton(OrderInterface::class, OrderRepository::class);
        $this->app->singleton(AuthInterface::class, AuthRepository::class);
        $this->app->singleton(ProductInterface::class, ProductRepository::class);
        $this->app->singleton(MultiImgInterface::class, MultiImgRepository::class);
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
