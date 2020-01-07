<?php

namespace App\Providers;

use App\Category;
use App\Policies\CategoryPolicy;
use App\Policies\ProductPolicy;
use App\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Category::class => CategoryPolicy::class,
        Product::class => ProductPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
