<?php

namespace App\Repositories;

use App\Infrastructure\Repositories\BaseRepositoryContract;
use Ramsey\Uuid\UuidInterface;

interface InvoiceRepositoryContract extends BaseRepositoryContract
{
    public function approveInvoiceByUuid(UuidInterface $uuId);
    public function rejectInvoiceByUuid(UuidInterface $uuId);
}
