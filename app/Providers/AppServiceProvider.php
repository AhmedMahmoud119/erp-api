<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Sanctum::authenticateAccessTokensUsing(function (PersonalAccessToken $token, $isValid) {
            if($isValid) return true;
            return $token->can('remember') && $token->created_at->gt(now()->subYears(5));
        });

        if (!Collection::hasMacro('paginate')) {

            Collection::macro('paginate',

                function ($perPage = 15, $page = null, $options = []) {
                    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                    return (new LengthAwarePaginator(
                        $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
                        ->withPath(url()->current());
                }

            );
        }
    }
}
