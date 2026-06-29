<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\company;
use App\Models\socialmedia;
use App\Models\policy;
use Illuminate\Support\Facades\View;

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
        //
         View::composer(
        [
            'User.Components.header',
            'User.Components.footer',
            'User.main'
        ],
        function ($view) {

            $companyData = company::first();
            $socialMediaData = socialmedia::first();
            $policiesData=policy::where('status',1)->latest()->get();

            $view->with([
                'companyData' => $companyData,
                'socialMedia' => $socialMediaData,
                'policies'=>$policiesData
            ]);
        }
    );
    }
}
