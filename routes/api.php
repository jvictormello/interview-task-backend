<?php

use App\Modules\Approval\Infrastructure\Http\Controllers\ApprovalController;
use App\Modules\Invoices\Infrastructure\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/invoices', [InvoiceController::class, 'index']);
Route::put('/invoices/{id}/approve', [ApprovalController::class, 'approve']);
Route::put('/invoices/{id}/reject', [ApprovalController::class, 'reject']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
