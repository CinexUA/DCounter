<?php


namespace App\Services\Sms;


use App\Services\Sms\Drivers\SmsClub;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SmsClient::class, function () {

            switch (config('sms.client')){
                default:
                    $driver = new SmsClub(
                        config('sms.smsclub.username'),
                        config('sms.smsclub.password'),
                        config('sms.smsclub.alpha')
                    );
            }

            return new SmsClient($driver);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
