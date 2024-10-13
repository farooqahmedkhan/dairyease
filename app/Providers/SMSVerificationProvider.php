<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SMSVerifierFactory;

class SMSVerificationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('verifier', function () {
            return SMSVerifierFactory::getVerifier();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
