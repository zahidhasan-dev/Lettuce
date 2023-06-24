<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FaqController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\ContactEmailController;
use App\Http\Controllers\ContactPhoneController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ContactAddressController;

Auth::routes(['verify'=> true]);

Route::controller(FrontendController::class)->group(function(){
    
    Route::get('/', 'index')->name('index');
    Route::get('/product/quick_view/{product}', 'quickViewProduct')->name('product.quick_view');
    Route::get('/shop/product/{product_slug}', 'productDetails')->name('product.details');
    Route::get('/shop/{category:category_slug?}/{subCategory:category_slug?}', 'shop')->name('shop');
    Route::get('/sale/{sale:sale_slug?}', 'shopSale')->name('shop.sale');
    Route::get('/about', 'about');
    Route::get('/contact', 'contact');
    Route::get('/faq', 'faq');
    Route::get('/wishlist', 'wishlist');
    Route::get('/cart', 'cart');
    Route::get('/checkout', 'checkout');
    Route::get('getcity/{country}', 'getCityByCountry')->name('getcity');
    Route::get('/thankyou', 'thankyou');

});

Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');
Route::match(['put','patch'],'cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('cart/{cart}/delete', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('cart/coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon.store');
Route::delete('cart/coupon/{coupon}/delete', [CartController::class, 'removeCoupon'])->name('cart.coupon.destroy');

Route::post('/wishlist/store',[WishlistController::class, 'store'])->name('wishlist.store');
Route::delete('/wishlist/{wishlist}/delete', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

Route::post('/checkout', [CheckoutController::class, 'checkoutPost'])->name('checkout.post');
Route::post('/checkout/pay', [CheckoutController::class, 'pay'])->name('checkout.pay');
Route::post('checkout/cart/destroy', [CheckoutController::class, 'destroyCart'])->name('checkout.cart.destroy');

Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe');
Route::get('/unsubscribe', [SubscriberController::class, 'unsubscribe'])->name('unsubscribe');

Route::post('message/store', [MessageController::class, 'store'])->name('message.store');

Route::middleware(['auth','verified','prevent-back-history'])->group(function(){

    Route::get('/customer/account', [CustomerController::class, 'customerAccount'])->name('customer.account');
    Route::get('/customer/order/{order_id}', [CustomerController::class, 'customerOrderItems'])->name('customer.order');
    Route::get('/customer/order/{order_id}/invoice', [CustomerController::class, 'customerOrderInvoice'])->name('customer.order.invoice');
    Route::match(['put','patch'],'customer/account/details/update', [CustomerController::class, 'customerDetailsUpdate'])->name('customer.account.details.update');
    Route::match(['put','patch'], 'customer/account/update', [CustomerController::class, 'CustomerAccountUpdate'])->name('customer.account.update');

    Route::post('/review/store', [ProductReviewController::class, 'storeReview'])->name('review.store');
    
    Route::middleware(['admin'])->group(function(){
        
        Route::group(['prefix'=>'admin'], function(){

            Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');

            Route::resource('about', AboutController::class);
            Route::get('about/{about}/status/update', [AboutController::class, 'updateAboutStatus'])->name('about.status.update');
            
            Route::resource('feature', FeatureController::class);
            Route::get('feature/{id}/status/update', [FeatureController::class, 'updateFeatureStatus'])->name('feature.status.update');

            Route::resource('contact/email', ContactEmailController::class);
            Route::get('contact/email/{id}/status/update', [ContactEmailController::class, 'updateEmailStatus'])->name('email.status.update');
            Route::get('contact/email/{id}/primary/status/update', [ContactEmailController::class, 'updatePrimaryEmailStatus'])->name('email.primary.status.update');

            Route::resource('contact/phone', ContactPhoneController::class);
            Route::get('contact/phone/{id}/status/update', [ContactPhoneController::class, 'updatePhoneStatus'])->name('phone.status.update');
            Route::get('contact/phone/{id}/primary/status/update', [ContactPhoneController::class, 'updatePrimaryPhoneStatus'])->name('phone.primary.status.update');

            Route::resource('contact/address', ContactAddressController::class);
            Route::get('contact/address/{id}/status/update', [ContactAddressController::class, 'updateAddressStatus'])->name('address.status.update');

            Route::resource('faq', FaqController::class);
            Route::post('faq/{faq}/status', [ FaqController::class , 'updateStatus'])->name('faq.updatestatus');
            Route::delete('faq/alldelete/{ids}', [ FaqController::class , 'delete_all_faq'])->name('faq.deleteall');

            Route::get('banner/search', [BannerController::class, 'bannerQuery'])->name('banner.search');
            Route::resource('banner', BannerController::class);
            Route::get('banner/{banner}/status/update', [BannerController::class, 'updateBannerStatus'])->name('banner.status.update');
            Route::post('banner/slug/create', [BannerController::class, 'createBannerSlug'])->name('banner.slug.create');
            
            Route::group(['prefix'=>'region'], function(){
                Route::resource('country', CountryController::class);
                Route::resource('city', CityController::class);
            });

            Route::get('discount/search', [DiscountController::class, 'queryDiscountData'])->name('discount.search');
            Route::resource('discount', DiscountController::class);
            Route::get('discount/{discount}/status', [DiscountController::class, 'updateDiscountStatus'])->name('discount.status.update');
            // Route::get('discount/expired/status/update', [DiscountController::class, 'updateStatusOnExpiry'])->name('discount.expired.status.update');  

            Route::get('coupon/search', [CouponController::class, 'queryCouponData'])->name('coupon.search');
            Route::resource('coupon', CouponController::class);
            Route::post('coupon/{coupon}/status', [CouponController::class, 'updateCouponStatus'])->name('coupon.status.update');
            Route::post('coupon/expired/{coupon}/status', [CouponController::class, 'updateStatusOnExpiry'])->name('coupon.expired.status.update');

            Route::get('user/admin', [UserController::class, 'user_admin'])->name('user.admin');
            Route::get('user/customer', [UserController::class, 'user_customer'])->name('user.customer');
            Route::get('user/{user_id}/details', [UserController::class, 'viewUserDetails'])->name('user.details');
            Route::get('user/register', [UserController::class, 'addUser'])->name('admin.user.register');
            Route::post('user/register', [UserController::class, 'createUser'])->name('admin.user.create');
            Route::get('user/{user}/edit', [UserController::class, 'editUserDetails'])->name('admin.user.edit');
            Route::match(['put','patch'],'user/{user}/edit', [UserController::class, 'updateUserDetails'])->name('admin.user.update');
            Route::delete('user/{user_id}/delete', [UserController::class, 'deleteUser'])->name('admin.user.delete');
            
            Route::get('/profile', [AdminController::class, 'admin_profile'])->name('admin.profile');
            Route::post('/password/update', [AdminController::class, 'updatePassword'])->name('admin.password.update');
            Route::get('/profile/edit', [AdminController::class, 'editUserDetails'])->name('admin.profile.edit');
            Route::post('/profile/update', [AdminController::class, 'updateUserDetails'])->name('admin.profile.update');
            Route::post('/profile/avatar/update', [AdminController::class, 'updateUserAvatar'])->name('admin.profile.avatar.update');
            Route::delete('/profile/avatar/remove', [AdminController::class, 'removeUserAvatar'])->name('admin.profile.avatar.remove');
            Route::get('/profile/city/by/country/{country_id}', [AdminController::class, 'getCityList'])->name('admin.profile.citybycountry');
            
            Route::post('category/search', [CategoryController::class, 'queryCategory'])->name('category.search');
            Route::resource('category',CategoryController::class);
            Route::post('category/{category}/status',[CategoryController::class, 'updateCategoryStatus'])->name('category.status.update');
            Route::post('category/update/{category}',[CategoryController::class, 'update'])->name('category.update');

            Route::get('product/trash', [ProductController::class, 'product_trash'])->name('product.trash');
            Route::get('product/{id}/restore', [ProductController::class, 'restore'])->name('product.restore');
            Route::post('product/restoreall', [ProductController::class, 'product_restore_all'])->name('product.restoreall');
            Route::resource('product', ProductController::class);
            Route::post('product/deleteall',[ProductController::class, 'productMassDestroy'])->name('product.deleteall');
            Route::delete('product/{id}/forcedelete',[ProductController::class, 'forceDelete'])->name('product.forcedelete');
            Route::post('product/forcedeleteall',[ProductController::class, 'productForceDeleteAll'])->name('product.forcedeleteall');
            Route::post('product/photo/delete',[ProductController::class, 'deleteProductPhoto'])->name('product.photo.delete');
            Route::get('product/{id}/feature/update', [ProductController::class, 'updateProductFeature'])->name('product.feature.update');
            Route::get('product/{id}/status/update', [ProductController::class, 'updateProductStatus'])->name('product.status.update');
            Route::get('product/discount/create', [ProductController::class, 'create_product_discount'])->name('product.discount.create');
            Route::post('product/discount/store', [ProductController::class, 'store_product_discount'])->name('product.discount.store');
            Route::post('product/by/category/products', [ProductController::class , 'products_by_category'])->name('product.category.products');
            Route::get('product/discount/{discount}/edit', [ProductController::class, 'edit_product_discount'])->name('product.discount.edit');
            Route::post('product/{product_id}/discount/update', [ProductController::class, 'update_product_discount'])->name('product.discount.update');
            Route::delete('product/{product_id}/discount/delete', [ProductController::class, 'deleteProductDiscount'])->name('product.discount.delete');

            Route::resource('size', ProductSizeController::class);

            Route::resource('order', OrderController::class);
            Route::post('order', [OrderController::class, 'queryOrder'])->name('order.search');
            Route::get('order/{order}/status/update', [OrderController::class, 'updateOrderStatus'])->name('order.status.update');
            Route::get('order/{order}/invoice', [OrderController::class, 'orderInvoice'])->name('admin.order.invoice');

            Route::post('newsletter/subscribers', [SubscriberController::class, 'querySubscriber'])->name('subscriber.search');
            Route::get('newsletter/subscribers', [SubscriberController::class, 'index'])->name('newsletter.subscriber');
            Route::get('newsletter/subscriber/{subscriber_id}', [SubscriberController::class, 'show'])->name('newsletter.subscriber.show');
            Route::delete('newsletter/subscriber/{subscriber_id}/delete', [SubscriberController::class, 'destroy'])->name('newsletter.subscriber.delete');

            Route::get('newsletters', [NewsletterController::class, 'index'])->name('newsletter.index');
            Route::post('newsletters', [NewsletterController::class, 'queryNewsletter'])->name('newsletter.search');
            Route::get('newsletters/{newsletter}/show', [NewsletterController::class, 'show'])->name('newsletter.show');
            Route::delete('newsletters/{newsletter}/delete', [NewsletterController::class, 'destroy'])->name('newsletter.delete');
            Route::get('newsletter/create', [NewsletterController::class, 'createNewsletter'])->name('newsletter.create');
            Route::post('newsletter/send', [NewsletterController::class, 'sendNewsletter'])->name('newsletter.send');
            Route::post('newsletter/preview', [NewsletterController::class, 'writePreviewNewsletter'])->name('newsletter.preview.write');
            Route::get('newsletter/preview', [NewsletterController::class, 'previewNewsletter'])->name('newsletter.preview');
            Route::post('newsletter/preview/remove', [NewsletterController::class, 'removeNewsletterPreview'])->name('newsletter.preview.remove');

            Route::get('messages', [MessageController::class, 'index'])->name('admin.message.index');
            Route::post('messages', [MessageController::class, 'queryMessage'])->name('admin.message.search');
            Route::get('messages/trash', [MessageController::class, 'message_trash'])->name('admin.message.trash');
            Route::get('message/{message}', [MessageController::class, 'show'])->name('admin.message.show');
            Route::delete('message/{message}', [MessageController::class, 'destroy'])->name('admin.message.destroy');
            Route::post('message/deleteall', [MessageController::class, 'massDestroy'])->name('admin.message.destroy.mass');
            Route::delete('message/{message}/delete', [MessageController::class, 'forceDelete'])->name('admin.message.force.destroy');
            Route::post('message/forcedeleteall', [MessageController::class, 'massForceDelete'])->name('admin.message.force.destroy.mass');
            Route::get('message/{message}/restore', [MessageController::class, 'restore'])->name('admin.message.restore');
            Route::post('message/restoreall', [MessageController::class, 'massRestore'])->name('admin.message.restore.mass');
            Route::post('message/reply', [MessageController::class, 'replyMessage'])->name('admin.message.reply');

            Route::group(['as'=>'admin.'], function(){

                Route::resource('role', RoleController::class);
    
                Route::resource('permission', PermissionController::class);
                
            });


            Route::get('settings/mail', [SettingsController::class, 'mailSettings'])->name('admin.settings.mail');
            Route::post('settings/mail/update', [SettingsController::class, 'createOrUpdateMailSettings'])->name('admin.settings.mail.update');
    
        
        });
    
    });

});
