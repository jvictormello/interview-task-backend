<?php

namespace App\Modules\Approval\Infrastructure\Http\Controllers;

use App\Infrastructure\Controller;
use App\Services\InvoiceServiceContract;
use Exception;
use Illuminate\Support\ItemNotFoundException;
use LogicException;
use Symfony\Component\HttpFoundation\Response;

class ApprovalController extends Controller
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
    public function approve(string $id)
    {
        try {
            $this->invoiceService->approveInvoice($id);
            return response()->json(['message' => 'Invoice approved'], Response::HTTP_OK);
        } catch (ItemNotFoundException $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode());
        } catch (LogicException $exception) {
            $errorCode = $exception->getCode() ? $exception->getCode() : Response::HTTP_METHOD_NOT_ALLOWED;
            return response()->json(['message' => $exception->getMessage()], $errorCode);
        } catch (Exception $exception) {
            $errorCode = $exception->getCode() ? $exception->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
            return response()->json(['message' => $exception->getMessage()], $errorCode);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reject(string $id)
    {
        try {
            $this->invoiceService->rejectInvoice($id);
            return response()->json(['message' => 'Invoice rejected'], Response::HTTP_OK);
        } catch (ItemNotFoundException $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode());
        } catch (LogicException $exception) {
            $errorCode = $exception->getCode() ? $exception->getCode() : Response::HTTP_METHOD_NOT_ALLOWED;
            return response()->json(['message' => $exception->getMessage()], $errorCode);
        } catch (Exception $exception) {
            $errorCode = $exception->getCode() ? $exception->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
            return response()->json(['message' => $exception->getMessage()], $errorCode);
        }
    }
}
