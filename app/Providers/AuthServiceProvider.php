<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\About' => 'App\Policies\AboutPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',
        'App\Models\ProductSize' => 'App\Policies\ProductSizePolicy',
        'App\Models\Feature' => 'App\Policies\FeaturePolicy',
        'App\Models\Banner' => 'App\Policies\BannerPolicy',
        'App\Models\ContactEmail' => 'App\Policies\ContactEmailPolicy',
        'App\Models\ContactPhone' => 'App\Policies\ContactPhonePolicy',
        'App\Models\ContactAddress' => 'App\Policies\ContactAddressPolicy',
        'App\Models\Faq' => 'App\Policies\FaqPolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\Coupon' => 'App\Policies\CouponPolicy',
        'App\Models\Discount' => 'App\Policies\DiscountPolicy',
        'App\Models\Order' => 'App\Policies\OrderPolicy',
        'App\Models\Country' => 'App\Policies\CountryPolicy',
        'App\Models\City' => 'App\Policies\CityPolicy',
        'App\Models\Subscriber' => 'App\Policies\SubscriberPolicy',
        'App\Models\Newsletter' => 'App\Policies\NewsletterPolicy',
        'App\Models\Message' => 'App\Policies\MessagePolicy',
        'App\Models\MailSetting' => 'App\Policies\MailSettingPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Role' => 'App\Policies\RolePolicy',
        'App\Models\Permission' => 'App\Policies\PermissionPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user, string $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

    }
}
