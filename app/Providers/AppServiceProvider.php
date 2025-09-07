<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Schema;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use App\Http\Middleware\ValidateRole;

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