<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeBlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login/owner', [AdminController::class, 'loginOwner'])->name('admin.login.owner');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/register', [AdminController::class, 'register'])->name('admin.register');
    Route::post('/register/create', [AdminController::class, 'registerCreate'])->name('admin.register.create');

    Route::get('/profile/{id}', [AdminController::class, 'profile'])->name('admin.profile')->middleware('admin');;
    Route::get('/profile/edit/{id}', [AdminController::class, 'editProfile'])->name('admin.profile.edit')->middleware('admin');
    Route::post('/profile/store/{id}', [AdminController::class, 'updateProfile'])->name('admin.profile.store')->middleware('admin');
    Route::get('/changepassword/{id}', [AdminController::class, 'changePassword'])->name('admin.change.password')->middleware('admin');
    Route::post('/update/password/{id}', [AdminController::class, 'updatePassword'])->name('admin.update.password')->middleware('admin');
});

Route::prefix('seller')->group(function (){
    Route::get('/login', [SellerController::class, 'login'])->name('seller.login');
    Route::post('/login/owner', [SellerController::class, 'loginOwner'])->name('login.owner');
    Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard')->middleware('seller');
    Route::get('/logout', [SellerController::class, 'logout'])->name('seller.logout');
    Route::get('/register', [SellerController::class, 'register'])->name('seller.register');
    Route::post('/register/create', [SellerController::class, 'registerCreate'])->name('seller.register.create');
});

Route::prefix('brand')->group(function() {
    Route::get('/view', [BrandController::class, 'index'])->name('all.brand');
    Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/update', [BrandController::class, 'update'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
});

Route::prefix('category')->group(function() {
    Route::get('/view', [CategoryController::class, 'allCategory'])->name('all.category');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    Route::get('/sub/view', [SubCategoryController::class, 'allSubCategory'])->name('all.subcategory');
    Route::post('/sub/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('/sub/update', [SubCategoryController::class, 'update'])->name('subcategory.update');
    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'delete'])->name('subcategory.delete');

    Route::get('/sub/sub/view', [SubCategoryController::class, 'allSubSubCategory'])->name('all.subsubcategory');
    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'getSubCategory']);
    Route::get('/subsubcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'getSubSubCategory']);
    Route::post('/sub/sub/store', [SubCategoryController::class, 'storeSubSubCategory'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{edit}', [SubCategoryController::class, 'editSubSubCategory'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update', [SubCategoryController::class, 'updateSubSubCategory'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'deleteSubSubCategory'])->name('subsubcategory.delete');
});

Route::prefix('product')->group(function() {
    Route::get('/add', [ProductController::class, 'create'])->name('add.product');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/manage', [ProductController::class, 'index'])->name('manage.product');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/delete/{id}', [ProductController::class, 'deleteProductData'])->name('product.delete');
    Route::post('/data/update', [ProductController::class, 'update'])->name('product.update');
    Route::post('/image/update', [ProductController::class, 'updateMultiImage'])->name('product.image.update');
    Route::post('/thumbnail/update', [ProductController::class, 'updateThumbnailImage'])->name('product.thumbnail.update');
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'deleteMultiImage'])->name('product.multiimage.delete');
    Route::get('/inactive/{id}', [ProductController::class, 'inactiveProduct'])->name('product.inactive');
    Route::get('/active/{id}', [ProductController::class, 'activeProduct'])->name('product.active');
});

Route::prefix('slider')->group(function() {
    Route::get('/view', [SliderController::class, 'allSlider'])->name('manage.slider');
    Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/update', [SliderController::class, 'update'])->name('slider.update');
    Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');

    Route::get('/inactive/{id}', [SliderController::class, 'inactive'])->name('slider.inactive');
    Route::get('/active/{id}', [SliderController::class, 'active'])->name('slider.active');
});

Route::prefix('coupons')->group(function() {
    Route::get('/view', [CouponController::class, 'couponView'])->name('manage.coupon');
    Route::post('/store', [CouponController::class, 'store'])->name('coupon.store');
    Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit');
    Route::post('/update/{id}', [CouponController::class, 'update'])->name('coupon.update');
    Route::get('/delete/{id}', [CouponController::class, 'delete'])->name('coupon.delete');
});

Route::prefix('shipping')->group(function() {
    Route::get('/division/view', [ShippingAreaController::class, 'viewDivision'])->name('manage.division');
    Route::post('/division/store', [ShippingAreaController::class, 'storeDivision'])->name('division.store');
    Route::get('/division/edit/{id}', [ShippingAreaController::class, 'editDivision'])->name('division.edit');
    Route::post('/division/update/{id}', [ShippingAreaController::class, 'updateDivision'])->name('division.update');
    Route::get('/division/delete/{id}', [ShippingAreaController::class, 'deleteDivision'])->name('division.delete');

    Route::get('/district/view', [ShippingAreaController::class, 'viewDistrict'])->name('manage.district');
    Route::post('/district/store', [ShippingAreaController::class, 'storeDistrict'])->name('district.store');
    Route::get('/district/edit/{id}', [ShippingAreaController::class, 'editDistrict'])->name('district.edit');
    Route::post('/district/update/{id}', [ShippingAreaController::class, 'updateDistrict'])->name('district.update');
    Route::get('/district/delete/{id}', [ShippingAreaController::class, 'deleteDistrict'])->name('district.delete');

    Route::get('/state/view', [ShippingAreaController::class, 'viewState'])->name('manage.state');
    Route::post('/state/store', [ShippingAreaController::class, 'storeState'])->name('state.store');
    Route::get('/state/get-district/{id}', [ShippingAreaController::class, 'getDistrict']);
    Route::get('/state/edit/{id}', [ShippingAreaController::class, 'editState'])->name('state.edit');
    Route::post('/state/update/{id}', [ShippingAreaController::class, 'updateState'])->name('state.update');
    Route::get('/state/delete/{id}', [ShippingAreaController::class, 'deleteState'])->name('state.delete');
});

Route::prefix('orders')->group(function() {
    Route::get('/pending', [OrderController::class, 'pendingOrders'])->name('pending.orders');
    Route::get('/confirmed', [OrderController::class, 'confirmedOrders'])->name('confirmed.orders');
    Route::get('/processing', [OrderController::class, 'processingOrders'])->name('processing.orders');
    Route::get('/picked', [OrderController::class, 'pickedOrders'])->name('picked.orders');
    Route::get('/shipped', [OrderController::class, 'shippedOrders'])->name('shipped.orders');
    Route::get('/delivered', [OrderController::class, 'deliveredOrders'])->name('delivered.orders');
    Route::get('/cancel', [OrderController::class, 'cancelOrders'])->name('cancel.orders');
    Route::get('/pending/confirm/{order_id}', [OrderController::class, 'pendingToConfirm'])->name('pending-confirm');
    Route::get('/confirm/processing/{order_id}', [OrderController::class, 'confirmToProcessing'])->name('confirm-processing');
    Route::get('/processing/picked/{order_id}', [OrderController::class, 'processingToPicked'])->name('processing-picked');
    Route::get('/picked/shipped/{order_id}', [OrderController::class, 'pickedToShipped'])->name('picked-shipped');
    Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'shippedToDelivered'])->name('shipped-delivered');
    Route::get('/delivered/canceled/{order_id}', [OrderController::class, 'DeliveredToCancel'])->name('delivered-cancel');
    Route::get('/invoice/download/{order_id}', [OrderController::class, 'downloadInvoice'])->name('invoice.download');
    Route::get('/pending/order/details/{order_id}', [OrderController::class, 'pendingOrderDetails'])->name('pending.order.details');

    Route::get('/return/request', [OrderController::class, 'requestReturnOrder'])->name('return.request');
    Route::get('/return/request/approve/${id}', [OrderController::class, 'approveRequestReturnOrder'])->name('return.approve');
    Route::get('/return/list/request/', [OrderController::class, 'allReturnOrder'])->name('all.return.request');
});

Route::prefix('reports')->group(function() {
    Route::get('/report-', [ReportController::class, 'allReport'])->name('manage.reports');
    Route::post('/search-by-date', [ReportController::class, 'reportByDate'])->name('search-by-date');
    Route::post('/search-by-month', [ReportController::class, 'reportByMonth'])->name('search-by-month');
    Route::post('/search-by-year', [ReportController::class, 'reportByYear'])->name('search-by-year');

    Route::get('/report-product', [ReportController::class, 'productReportView'])->name('manage-product-report');
    Route::post('/best-seller-product', [ReportController::class, 'bestSellerProduct'])->name('top-n-bestseller');
});

Route::prefix('blog')->group(function () {
    Route::get('/category', [BlogController::class, 'blogCategory'])->name('blog.category');
    Route::post('/store', [BlogController::class, 'saveBlogCategory'])->name('blogcategory.store');
    Route::get('/category/edit/{id}', [BlogController::class, 'editBlogCategory'])->name('blogcategory.edit');
    Route::post('/update', [BlogController::class, 'updateBlogCategory'])->name('blogcategory.update');

    Route::get('/post/list', [BlogController::class, 'listBlogPost'])->name('list.post');
    Route::get('/post/add', [BlogController::class, 'createBlogPost'])->name('add.post');
    Route::post('/post/save', [BlogController::class, 'saveBlogPost'])->name('save.post');
    Route::get('/post/edit/{id}', [BlogController::class, 'editBlogPost'])->name('post.edit');
    Route::post('/post/update/{id}', [BlogController::class, 'updateBlogPost'])->name('post.update');
    Route::get('/post/delete/{id}', [BlogController::class, 'deleteBlogPost'])->name('post.delete');
});

Route::prefix('setting')->group(function () {
    Route::get('/site', [SiteSettingController::class, 'siteSetting'])->name('site.setting');
    Route::post('/site/update', [SiteSettingController::class, 'updateSiteSetting'])->name('site.setting.update');
    Route::get('/seo', [SiteSettingController::class, 'seoSetting'])->name('seo.setting');
    Route::post('/seo/update', [SiteSettingController::class, 'updateSeoSetting'])->name('seo.setting.update');
});

Route::prefix('alluser')->group(function() {
    Route::get('/view', [AdminController::class, 'allUser'])->name('manage.user');
});


/*========================= FRONTEND ROUTE ========================*/
Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', [HomeController::class, 'index'])->name('user.dashboard');
Route::get('/user/logout', [HomeController::class, 'logout'])->name('user.logout');
Route::get('/user/profile', [HomeController::class, 'profile'])->name('user.profile');
Route::post('/user/profile/store', [HomeController::class, 'profileStore'])->name('user.profile.store');
Route::get('user/change/password', [HomeController::class, 'changePassword'])->name('change.password');
Route::post('user/password/update', [HomeController::class, 'updatePassword'])->name('user.password.update');

Route::get('/language/english', [LanguageController::class, 'english'])->name('english.language');
Route::get('/language/vietnam', [LanguageController::class, 'vietnam'])->name('vietnam.language');

Route::get('/product/details/{id}/{slug}', [HomeController::class, 'productDetail']);

Route::get('/product/tag/{tag}', [HomeController::class, 'tagWiseProduct']);

Route::get('/subcategory/product/{id}/{slug}', [HomeController::class, 'subCategoryWiseProduct']);

Route::get('/subsubcategory/product/{id}/{slug}', [HomeController::class, 'subSubCategoryWiseProduct']);

Route::get('/product/view/modal/{id}', [HomeController::class, 'previewProductAjax']);

Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);

Route::get('/product/mini/cart', [CartController::class, 'addMiniCart']);

Route::get('/minicart/product-remove/{id}', [CartController::class, 'removeMiniCart']);

Route::prefix('user')->group(function(){
    Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'addToWishlist']);
    Route::get('/wishlist', [WishlistController::class, 'allWishlist'])->name('wishlist');
    Route::get('/get-wishlist-product', [WishlistController::class, 'getWishList']);
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'removeWishlist']);
    Route::post('/stripe/order', [StripeController::class, 'stripeOrder'])->name('stripe.order');
    Route::post('/cash/order', [CashController::class, 'cashOrder'])->name('cash.order');

    Route::get('/my-orders', [UserController::class, 'myOrder'])->name('my.orders');
    Route::get('/order-details/{order_id}', [UserController::class, 'orderDetails']);
    Route::get('/invoice-download/{order_id}', [UserController::class, 'downloadInvoice']);

    Route::post('/return/order/{order_id}', [OrderController::class, 'returnOrder'])->name('return.order');
    Route::get('/my-orders/return', [OrderController::class, 'myOrderReturn'])->name('my.orders.return');
    Route::get('/my-orders/cancel', [OrderController::class, 'myOrderCancel'])->name('my.orders.cancel');
});

Route::get('/mycart', [CartPageController::class, 'myCart'])->name('mycart');
Route::get('/user/get-cart-product', [CartPageController::class, 'getCartProduct']);
Route::get('/user/cart-remove/{id}', [CartPageController::class, 'removeProductFromCart']);
Route::get('/cart-increment/{id}', [CartPageController::class, 'increaseQuantity']);
Route::get('/cart-decrement/{id}', [CartPageController::class, 'decreaseQuantity']);

Route::post('/coupon-apply', [CartController::class, 'applyCoupon']);
Route::get('/coupon-calculation', [CartController::class, 'calculationCoupon']);
Route::get('/coupon-remove', [CartController::class, 'removeCoupon']);

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('/shipping/get-district/{division_id}', [CheckoutController::class, 'getDistrict']);
Route::get('/shipping/get-state/{district_id}', [CheckoutController::class, 'getState']);
Route::post('/checkout/store', [CheckoutController::class, 'storeCheckout'])->name('checkout.store');

Route::get('/blog/home', [HomeBlogController::class, 'list'])->name('home.blog');
Route::get('/blog/detail/{id}', [HomeBlogController::class, 'detail'])->name('blog.detail');
Route::get('/blog/category/post/{category_id}', [HomeBlogController::class, 'homeBlogCategoryPost']);

