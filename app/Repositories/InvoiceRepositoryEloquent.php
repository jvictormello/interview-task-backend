<?php

namespace App\Repositories;

use App\Domain\Enums\StatusEnum;
use App\Infrastructure\Models\Invoice;
use App\Infrastructure\Repositories\BaseRepositoryEloquent;
use Ramsey\Uuid\UuidInterface;

class InvoiceRepositoryEloquent extends BaseRepositoryEloquent implements InvoiceRepositoryContract
{
    protected $model;

    public function __construct(Invoice $invoice)
    {
        $this->model = $invoice;
    }

    public function approveInvoiceByUuid(UuidInterface $uuId)
    {
        return $this->model->where('id', $uuId->toString())->update(['status' => StatusEnum::APPROVED]);
    }

    public function rejectInvoiceByUuid(UuidInterface $uuId)
    {
        return $this->model->where('id', $uuId->toString())->update(['status' => StatusEnum::REJECTED]);
    }
}
