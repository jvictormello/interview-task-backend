<?php

namespace App\Modules\Invoices\Services;

use App\Infrastructure\Models\Invoice;
use App\Modules\Invoices\Repositories\InvoiceRepositoryContract;

class InvoiceService implements InvoiceServiceContract
{
    protected $invoiceRepository;

    public function __construct(InvoiceRepositoryContract $invoiceRepositoryContract)
    {
        $this->invoiceRepository = $invoiceRepositoryContract;
    }

    public function getAllInvoices()
    {
        $invoices = Invoice::with('company')->with('invoice_product_lines.product')->get();

        return $invoices;
    }
}
