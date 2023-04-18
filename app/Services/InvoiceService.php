<?php

namespace App\Services;

use App\Infrastructure\Models\Invoice;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Repositories\InvoiceRepositoryContract;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

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
        $uuId = Uuid::fromString($id);
        $invoiceDto = new ApprovalDto($uuId, $invoice->status, $invoice->company->name);

        $this->approvalFacade->approve($invoiceDto);

        $this->invoiceRepository->approveInvoiceByUuid($uuId);
    }

    public function rejectInvoice(string $id)
    {
        $invoice = $this->invoiceRepository->getByAttribute('id', $id)->firstOrFail();
        $uuId = Uuid::fromString($id);
        $invoiceDto = new ApprovalDto($uuId, $invoice->status, $invoice->company->name);

        if (!$this->approvalFacade->reject($invoiceDto)) {
            throw new Exception('This invoice is not approvable', Response::HTTP_METHOD_NOT_ALLOWED);
        }

        $this->invoiceRepository->rejectInvoiceByUuid($uuId);
    }
}
