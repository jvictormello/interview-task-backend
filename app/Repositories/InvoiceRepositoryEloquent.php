<?php

namespace App\Repositories;

use App\Infrastructure\Models\Invoice;
use App\Infrastructure\Repositories\BaseRepositoryEloquent;

class InvoiceRepositoryEloquent extends BaseRepositoryEloquent implements InvoiceRepositoryContract
{
    protected $model;

    public function __construct(Invoice $invoice)
    {
        $this->model = $invoice;
    }
}
