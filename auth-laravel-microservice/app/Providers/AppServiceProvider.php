<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Config Passport
        Passport::loadKeysFrom(storage_path());
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        // Accept Admin Role
        Gate::before(fn ($user, $ability) => $user->role == User::ADMIN ? true : null);
    }
}
