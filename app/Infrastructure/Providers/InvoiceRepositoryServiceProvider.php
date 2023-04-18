<?php

namespace App\Infrastructure\Providers;

use App\Modules\Invoices\Repositories\InvoiceRepositoryContract;
use App\Modules\Invoices\Repositories\InvoiceRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class InvoiceRepositoryServiceProvider extends ServiceProvider
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
            InvoiceRepositoryContract::class,
            InvoiceRepositoryEloquent::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        return [InvoiceRepositoryContract::class];
    }
}
