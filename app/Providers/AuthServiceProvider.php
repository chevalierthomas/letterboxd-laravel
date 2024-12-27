<?php

namespace App\Providers;

use App\Models\Review;
use App\Policies\ReviewPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Les mappings des policies pour l'application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Review::class => ReviewPolicy::class,
    ];

    /**
     * Enregistrement des services d'authentification/autorisation.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
