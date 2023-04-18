<?php

namespace App\Services;

use App\Infrastructure\Models\Invoice;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Repositories\InvoiceRepositoryContract;
use Ramsey\Uuid\Uuid;

class InvoiceService implements InvoiceServiceContract
{
    protected $invoiceRepository;
    protected $approvalFacade;

    public function __construct(
        InvoiceRepositoryContract $invoiceRepositoryContract,
        ApprovalFacadeInterface $approvalFacadeInterface
    )
    {
        $this->invoiceRepository = $invoiceRepositoryContract;
        $this->approvalFacade = $approvalFacadeInterface;
    }

    public function getAllInvoices()
    {
        $invoices = Invoice::with('company')->with('invoice_product_lines.product')->get();

        return $invoices;
    }

    public function approveInvoice(string $id)
    {
        $invoice = $this->invoiceRepository->getByAttribute('id', $id)->firstOrFail();
        $castId = Uuid::fromString($id);
        $invoiceDto = new ApprovalDto($castId, $invoice->status, $invoice->company->name);

        $this->approvalFacade->approve($invoiceDto);
    }
}
