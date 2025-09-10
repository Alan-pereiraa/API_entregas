<?php

namespace App\Providers;

use App\Http\Middleware\ValidateRole;
use App\Models\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

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
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        $this->app['router']->aliasMiddleware('role', ValidateRole::class);
        Route::prefix('api')
            ->middleware('api')
            ->group(function () {
                require base_path('routes/api.php');
            });

        Schema::defaultStringLength(191);
    }
}
