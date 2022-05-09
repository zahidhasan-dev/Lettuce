<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSizeController;



Route::get('/', function () {
    return view('frontend.home');
})->name('index');

Auth::routes(['verify'=> true]);


Route::controller(FrontendController::class)->group(function(){
    
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/shop/product/{product_slug}', 'productDetails')->name('product.details');
    Route::get('/about', 'about');
    Route::get('/contact', 'contact');
    Route::get('/faq', 'faq');
    Route::get('/wishlist', 'wishlist');
    Route::get('/cart', 'cart');
    Route::get('/checkout', 'checkout');

});


Route::middleware(['auth','verified','prevent-back-history'])->group(function(){
    
    Route::get('/customer/account', [CustomerController::class, 'customerAccount'])->name('customer.account');
    
    Route::middleware(['admin'])->group(function(){
        
        Route::group(['prefix'=>'admin'], function(){

            Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
        
            Route::resource('faq', FaqController::class);
            Route::post('faq/{faq}/status', [ FaqController::class , 'updateStatus'])->name('faq.updatestatus');
            Route::delete('faq/alldelete/{ids}', [ FaqController::class , 'delete_all_faq'])->name('faq.deleteall');

            Route::resource('banner', BannerController::class);
            
            Route::group(['prefix'=>'region'], function(){

                Route::resource('country', CountryController::class);
                Route::resource('city', CityController::class);

            });


            Route::get('discount/search', [DiscountController::class, 'queryDiscountData'])->name('discount.search');
            Route::resource('discount', DiscountController::class);
            Route::post('discount/{discount}/status', [DiscountController::class, 'updateDiscountStatus'])->name('discount.status.update');
            Route::post('discount/expired/{discount}/status', [DiscountController::class, 'updateStatusOnExpiry'])->name('discount.expired.status.update');  

            Route::get('coupon/search', [CouponController::class, 'queryCouponData'])->name('coupon.search');
            Route::resource('coupon', CouponController::class);
            Route::post('coupon/{coupon}/status', [CouponController::class, 'updateCouponStatus'])->name('coupon.status.update');
            Route::post('coupon/expired/{coupon}/status', [CouponController::class, 'updateStatusOnExpiry'])->name('coupon.expired.status.update');

            Route::get('user/admin', [UserController::class, 'user_admin'])->name('user.admin');
            Route::get('user/customer', [UserController::class, 'user_customer'])->name('user.customer');
            Route::get('user/{user_id}/details', [UserController::class, 'viewUserDetails'])->name('user.details');
            Route::get('user/register', [UserController::class, 'addUser'])->name('admin.user.register');
            Route::post('user/register', [UserController::class, 'createUser'])->name('admin.user.create');
            Route::delete('user/{user_id}/delete', [UserController::class, 'deleteUser'])->name('admin.user.delete');
            
            Route::get('/profile', [AdminController::class, 'admin_profile'])->name('admin.profile');
            Route::post('/password/update', [AdminController::class, 'updatePassword'])->name('admin.password.update');
            Route::get('/profile/edit', [AdminController::class, 'editUserDetails'])->name('admin.profile.edit');
            Route::post('/profile/update', [AdminController::class, 'updateUserDetails'])->name('admin.profile.update');
            Route::post('/profile/avatar/update', [AdminController::class, 'updateUserAvatar'])->name('admin.profile.avatar.update');
            Route::delete('/profile/avatar/remove', [AdminController::class, 'removeUserAvatar'])->name('admin.profile.avatar.remove');
            Route::get('/profile/city/by/country/{country_id}', [AdminController::class, 'getCityList'])->name('admin.profile.citybycountry');
            

            Route::get('category/search', [CategoryController::class, 'queryCategory'])->name('category.search');
            Route::resource('category',CategoryController::class);
            Route::post('category/{category}/status',[CategoryController::class, 'updateCategoryStatus'])->name('category.status.update');
            Route::post('category/update/{category}',[CategoryController::class, 'update'])->name('category.update');

            Route::resource('product', ProductController::class);
            Route::post('product/{id}/feature/update', [ProductController::class, 'updateProductFeature'])->name('product.feature.update');
            Route::post('product/{id}/status/update', [ProductController::class, 'updateProductStatus'])->name('product.status.update');

            Route::resource('size', ProductSizeController::class);
        
        });
    
    });

});


