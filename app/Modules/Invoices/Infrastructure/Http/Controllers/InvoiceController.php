<?php

namespace App\Modules\Invoices\Infrastructure\Http\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Invoices\Services\InvoiceServiceContract;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(
        InvoiceServiceContract $invoiceServiceContract
    )
    {
        $this->invoiceService = $invoiceServiceContract;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            return response()->json($this->invoiceService->getAllInvoices());
        } catch (Exception $exception) {
            $errorCode = $exception->getCode() ? $exception->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
            return response()->json(['message' => $exception->getMessage()], $errorCode);
        }
    }
}
