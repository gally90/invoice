<?php

namespace Gally90\Invoice;



use Illuminate\Support\ServiceProvider;

class InvoiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__.'/../vendor/autoload.php';
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'invoice');
        $this->app->register('Barryvdh\DomPDF\ServiceProvider');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/invoice.php' => config_path('invoice.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/../fonts' => storage_path('fonts'),
        ], 'storage');
    }
}
