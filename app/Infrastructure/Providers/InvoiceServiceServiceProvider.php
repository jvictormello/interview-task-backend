<?php

namespace App\Infrastructure\Providers;

use App\Modules\Invoices\Services\InvoiceService;
use App\Modules\Invoices\Services\InvoiceServiceContract;
use Illuminate\Support\ServiceProvider;

class InvoiceServiceServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            InvoiceServiceContract::class,
            InvoiceService::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        return [InvoiceServiceContract::class];
    }
}
