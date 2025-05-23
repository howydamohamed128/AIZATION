<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Order;
use App\Models\Branch;
use App\Models\Coupon;
use App\Models\Manager;
use App\Models\Customer;
use App\Models\Operator;
use App\Models\AddressBook;
use App\Models\ContactType;
use App\Models\Content\Page;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Models\Location\City;
use App\Policies\OrderPolicy;
use App\Models\Catalog\Option;
use App\Models\Content\Banner;
use App\Policies\BranchPolicy;
use App\Policies\CouponPolicy;
use App\Models\Catalog\Product;
use App\Models\Content\Contact;
use App\Policies\ManagerPolicy;
use App\Models\Catalog\Category;
use App\Models\WholesaleRequest;
use App\Policies\CustomerPolicy;
use App\Policies\OperatorPolicy;
use App\Models\Location\District;
use Spatie\Permission\Models\Role;
use App\Policies\AddressBookPolicy;
use App\Policies\ContactTypePolicy;
use App\Models\Content\CategoryPost;
use App\Policies\Content\PagePolicy;
use App\Policies\Location\CityPolicy;
use App\Models\Content\CustomerReview;
use App\Policies\Catalog\OptionPolicy;
use App\Policies\Content\BannerPolicy;
use App\Models\Report\CustomersPayment;
use App\Policies\Catalog\ProductPolicy;
use App\Policies\Content\ContactPolicy;
use App\Policies\Catalog\CategoryPolicy;
use App\Policies\WholesaleRequestPolicy;
use App\Policies\Location\DistrictPolicy;
use App\Policies\Content\CategoryPostPolicy;
use App\Policies\Content\CustomerReviewPolicy;
use App\Policies\Report\CustomersPaymentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Customer::class => CustomerPolicy::class,
        Product::class => ProductPolicy::class,
       CategoryPost::class => CategoryPostPolicy::class,
        // Manager::class => ManagerPolicy::class,
        // Operator::class => OperatorPolicy::class,
        // Page::class => PagePolicy::class,
        Banner::class => BannerPolicy::class,
        Role::class => RolePolicy::class,
        // Order::class => OrderPolicy::class,
        // Coupon::class => CouponPolicy::class,
        // CustomersPayment::class => CustomersPaymentPolicy::class,
        User::class => UserPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void {
        //
    }
}
