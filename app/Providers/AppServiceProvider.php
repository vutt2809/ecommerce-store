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
use App\Repositories\ShipDistrict\ShipDistrictInterface;
use App\Repositories\ShipDistrict\ShipDistrictRepository;
use App\Repositories\ShipDivision\ShipDivisionRepository;
use App\Repositories\ShipState\ShipStateRepository;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\ShipDivision\ShipDivisionInterface;
use App\Repositories\ShipState\ShipStateInterface;
use App\Repositories\Slider\SliderInterface;
use App\Repositories\Slider\SliderRepository;
use App\Repositories\SubCategory\SubCategoryInterface;
use App\Repositories\SubCategory\SubCategoryRepository;
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
        $this->app->singleton(OrderInterface::class, OrderRepository::class);
        $this->app->singleton(ShipDivisionInterface::class, ShipDivisionRepository::class);
        $this->app->singleton(ShipDistrictInterface::class, ShipDistrictRepository::class);
        $this->app->singleton(ShipStateInterface::class, ShipStateRepository::class);
        $this->app->singleton(SliderInterface::class, SliderRepository::class);
        $this->app->singleton(SubCategoryInterface::class, SubCategoryRepository::class);
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
