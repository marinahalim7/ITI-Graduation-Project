<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ApiContext::class, function ($app) {
            $apiContext = new ApiContext(
                new OAuthTokenCredential(
                    config('services.paypal.client_id'),
                    config('services.paypal.secret')
                )
            );

            $apiContext->setConfig([
                'mode' => config('services.paypal.mode')
            ]);

            return $apiContext;
        });
    }
}
