<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\{Company, User, Category, Product, Order, OrderItem, Payment, Notification};
use App\Policies\{CompanyPolicy, UserPolicy, CategoryPolicy, ProductPolicy, OrderPolicy, OrderItemPolicy, PaymentPolicy, NotificationPolicy};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Company::class => CompanyPolicy::class,
        User::class => UserPolicy::class,
        Category::class => CategoryPolicy::class,
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
        OrderItem::class => OrderItemPolicy::class,
        Payment::class => PaymentPolicy::class,
        Notification::class => NotificationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gates supplémentaires si nécessaire
        Gate::define('manage-company', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('view-analytics', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
