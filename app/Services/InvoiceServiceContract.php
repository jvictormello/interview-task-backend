<?php

namespace App\Services;

interface InvoiceServiceContract
{
    public function getAllInvoices();
    public function approveInvoice(string $id);
}
