<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PrinterApiController;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;


Route::get('printers', [PrinterApiController::class, 'index']);          // Get all
Route::get('html_code', [PrinterApiController::class, 'getSCImage']);          // Get all

