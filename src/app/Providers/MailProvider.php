<?php

namespace App\Providers;

use App\Mail\Transport\MailTransport;
use Illuminate\Mail\MailServiceProvider;
use Swift_Mailer;

class MailProvider extends MailServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    /*public function register()
    {
        $this->registerSwiftMailer();
    }*/

    /**
     * Bootstrap services.
     *
     * @return void
     */
    /*public function boot()
    {
        //
    }*/

    function registerSwiftMailer()
    {
        if ($this->app['config']['mail.driver'] == 'mail') {
            $this->registerMailSwiftMailer();
        } else {
            parent::registerSwiftMailer();
        }
    }

    private function registerMailSwiftMailer()
    {
        $this->app->singleton('swift.mailer', function () {
            return new Swift_Mailer(new MailTransport());
        });
    }
}
