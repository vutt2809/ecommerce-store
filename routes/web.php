<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;



require __DIR__.'/auth.php';

// 
/* ==========================Admin Auth Route============================*/
Route::prefix('admin')->group(function (){
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login/owner', [AdminController::class, 'loginOwner'])->name('admin.login.owner');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/register', [AdminController::class, 'register'])->name('admin.register');
    Route::post('/register/create', [AdminController::class, 'registerCreate'])->name('admin.register.create');

    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
    Route::post('/admin/profile/store', [AdminController::class, 'updateProfile'])->name('admin.profile.store');
    Route::get('/admin/changepassword', [AdminController::class, 'changePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'updatePassword'])->name('admin.update.password');
});
/* ========================End Admin Auth Route==========================*/



/* ==========================Seller Auth Route============================*/
Route::prefix('seller')->group(function (){
    Route::get('/login', [SellerController::class, 'login'])->name('seller.login');
    Route::post('/login/owner', [SellerController::class, 'loginOwner'])->name('login.owner');
    Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard')->middleware('seller');
    Route::get('/logout', [SellerController::class, 'logout'])->name('seller.logout');
    Route::get('/register', [SellerController::class, 'register'])->name('seller.register');
    Route::post('/register/create', [SellerController::class, 'registerCreate'])->name('seller.register.create');
});
/* ========================End Seller Auth Route==========================*/

/*======================= Brand Route =======================*/
Route::prefix('brand')->group(function() {
    Route::get('/view', [BrandController::class, 'allBrand'])->name('all.brand');
    Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/update', [BrandController::class, 'update'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
});
/*======================= End Brand Route =======================*/


/*======================= Category Route =======================*/
Route::prefix('category')->group(function() {
    Route::get('/view', [CategoryController::class, 'allCategory'])->name('all.category');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    /*======================= SubCategory Route =======================*/
    Route::get('/sub/view', [SubCategoryController::class, 'allSubCategory'])->name('all.subcategory');
    Route::post('/sub/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('/sub/update', [SubCategoryController::class, 'update'])->name('subcategory.update');
    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'delete'])->name('subcategory.delete');   
    /*======================= SubsubCategory Route =======================*/
    Route::get('/sub/sub/view', [SubCategoryController::class, 'allSubSubCategory'])->name('all.subsubcategory');
    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'getSubCategory']);
    Route::get('/subsubcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'getSubSubCategory']);
    Route::post('/sub/sub/store', [SubCategoryController::class, 'storeSubSubCategory'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{edit}', [SubCategoryController::class, 'editSubSubCategory'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update', [SubCategoryController::class, 'updateSubSubCategory'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'deleteSubSubCategory'])->name('subsubcategory.delete');          
});
/*======================= End Category Route =======================*/



/*======================= Admin Product Route =======================*/
Route::prefix('product')->group(function() {
    Route::get('/add', [ProductController::class, 'add'])->name('add.product');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/manage', [ProductController::class, 'manage'])->name('manage.product');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/delete/{id}', [ProductController::class, 'deleteProductData'])->name('product.delete');
    Route::post('/data/update', [ProductController::class, 'update'])->name('product.update');
    Route::post('/image/update', [ProductController::class, 'updateMultiImage'])->name('product.image.update');
    Route::post('/thumbnail/update', [ProductController::class, 'updateThumbnailImage'])->name('product.thumbnail.update');
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'deleteMultiImage'])->name('product.multiimage.delete');
    Route::get('/inactive/{id}', [ProductController::class, 'inactiveProduct'])->name('product.inactive');
    Route::get('/active/{id}', [ProductController::class, 'activeProduct'])->name('product.active');
});
/*======================= End Admin Product Route =======================*/



/*======================= Admin Slider Route =======================*/
Route::prefix('slider')->group(function() {
    Route::get('/view', [SliderController::class, 'allSlider'])->name('manage.slider');
    Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/update', [SliderController::class, 'update'])->name('slider.update');
    Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');

    Route::get('/inactive/{id}', [SliderController::class, 'inactive'])->name('slider.inactive');
    Route::get('/active/{id}', [SliderController::class, 'active'])->name('slider.active');
});
/*======================= End Admin Slider Route =======================*/




/*========================= FRONTEND ROUTE ========================*/

/*========================= User Route ========================*/
Route::get('/', [HomeController::class, 'index']);
Route::get('/user/logout', [HomeController::class, 'logout'])->name('user.logout');
Route::get('/user/profile', [HomeController::class, 'profile'])->name('user.profile');
Route::post('/user/profile/store', [HomeController::class, 'profileStore'])->name('user.profile.store');
Route::get('user/change/password', [HomeController::class, 'changePassword'])->name('change.password');
Route::post('user/password/update', [HomeController::class, 'updatePassword'])->name('user.password.update');
/*======================= End User Route =======================*/


/*========================= Language Route ========================*/
Route::get('/language/english', [LanguageController::class, 'english'])->name('english.language');
Route::get('/language/vietnam', [LanguageController::class, 'vietnam'])->name('vietnam.language');
/*========================= Language Route ========================*/

/*========================= Product Details ========================*/
Route::get('/product/details/{id}/{slug}', [HomeController::class, 'productDetail']);
/*========================= Product Details ========================*/

/*========================= Product Tags========================*/
Route::get('/product/tag/{tag}', [HomeController::class, 'tagWiseProduct']);
/*========================= Product Tags========================*/

/*========================= Frontend Subcategory Data ========================*/
Route::get('/subcategory/product/{id}/{slug}', [HomeController::class, 'subCategoryWiseProduct']);
/*========================= End Frontend Subcategory Data ========================*/

/*========================= Frontend SubSubcategory Data ========================*/
Route::get('/subsubcategory/product/{id}/{slug}', [HomeController::class, 'subSubCategoryWiseProduct']);
/*========================= End Frontend SubSubcategory Data ========================*/

/*========================= Product View Modal With Ajax ========================*/
Route::get('/product/view/modal/{id}', [HomeController::class, 'previewProductAjax']);
/*========================= End Product View Modal With Ajax ========================*/




/*========================= Shopping Cart ========================*/
Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);
/*========================= End Shopping Cart ========================*/

/*========================= Mini Cart ========================*/
Route::get('/product/mini/cart', [CartController::class, 'addMiniCart']);
Route::get('/minicart/product-remove/{id}', [CartController::class, 'removeMiniCart']);
/*========================= End Mini Cart ========================*/