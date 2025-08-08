<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PrinterApiController;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;


Route::get('printers', [PrinterApiController::class, 'index']);          // Get all
Route::get('html_code', [PrinterApiController::class, 'getHTML']);
Route::get('html_code_2', [PrinterApiController::class, 'getHTMLSP']);          // Get all
     // Get all
Route::get('generate-pdf', function () {
    $html = '
    <style>
      @page { margin: 0; }
      body { margin: 0; padding: 0; }
    </style>
    <h1 style="text-align:center;">Hello Landscape PDF!</h1>
    <p>This PDF is generated in landscape mode with no margins.</p>
    ';

    $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');

    return response($pdf->output(), 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="landscape.pdf"');
});


Route::get('/rotated-pdf', function () {
    // Step 1: Fetch HTML from remote URL
    $response = Http::get('https://dev.vrlapps.com/corevrl/core_app_booking/bk_gcprint_collection_landscap.aspx');

    if ($response->failed()) {
        return response('Failed to fetch URL', 500);
    }

    $html = $response->body();

    // Step 2: Extract the <table> from the HTML
    $dom = new \DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $tables = $dom->getElementsByTagName('table');

    $tablesHtml = '';
    if ($tables->length > 1) {
        $tablesHtml .= $dom->saveHTML($tables[1]);
    } elseif ($tables->length > 0) {
        $tablesHtml .= $dom->saveHTML($tables[0]);
    } else {
        return response('No table found in the HTML.', 404);
    }

    // Step 3: Wrap in styled HTML for 90° rotation
    $finalHtml = '
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            margin: 0;
            padding: 0;
        }
        .rotated-content {
            transform: rotate(90deg);
            transform-origin: top left;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100vh;
            height: 100vw;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
            font-size: 10px;
        }
    </style>

    <div class="rotated-content">
        ' . $tablesHtml . '
    </div>
    ';

    // Step 4: Generate PDF from rotated HTML
    $pdf = Pdf::loadHTML($finalHtml)
        ->setPaper('a4', 'portrait');

    // Step 5: Return streamed PDF (in-memory, no file saved)
    return response($pdf->output(), 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="rotated-table.pdf"');
});

