<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Printer;
use Illuminate\Support\Facades\Http;
use Spatie\Browsershot\Browsershot;
use mikehaertl\wkhtmlto\Image;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PrinterApiController extends Controller
{
   public function index()
    {
        try {
            $printers = Printer::select('id','mac_address', 'model')->get();

            return response()->json([
                'status' => true,
                'message' => 'Data retrieved successfully',
                'data' => $printers
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function getHTML()
    {
        try {
            $response = Http::get('https://dev.vrlapps.com/corevrl/core_app_booking/bk_gcprint_collection_landscap.aspx');

            if ($response->failed()) {
                return response('Failed to fetch URL', 500);
            }

            $html = $response->body();

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

           return $tablesHtml;

        } catch (\Exception $e) {
            return response('Something went wrong: ' . $e->getMessage(), 500);
        }
    }

 public function getHTMLSP()
{
    try {
        $response = Http::get('https://dev.vrlapps.com/corevrl/core_app_booking/bk_gcprint_collection_landscap.aspx');
        if ($response->failed()) {
            return response('Failed to fetch URL', 500);
        }

        $html = $response->body();
        $imageName = 'table-image-mobile.png';
        $imagePath = public_path($imageName);

        $fullwidth = 720;
        $fullHeight = 300;

        // Ensure Puppeteer doesn't try to use restricted dirs
        Browsershot::html($html)
            ->windowSize($fullwidth, $fullHeight)
            ->deviceScaleFactor(2)
            ->waitUntilNetworkIdle()
            ->setOption('args', [
            '--no-sandbox',
            '--disable-setuid-sandbox',
            '--disable-dev-shm-usage',
            '--user-data-dir=/tmp/puppeteer',
            '--disable-crash-reporter',
            '--no-first-run',
            '--no-default-browser-check',
            '--disable-background-networking',
            '--disable-sync',
            '--metrics-recording-only',
            '--disable-default-apps',
            '--crash-dumps-dir=/tmp/chrome-crashpad', // ✅ <--- This is new
            '--crash-dumps-dir=/tmp/chrome-crashpad',
            ])
            ->setOption('executablePath', '/usr/bin/google-chrome')
            ->setEnvironmentVariable('HOME', '/tmp')  // ✅ This is critical
            ->save($imagePath);

        $imageUrl = url($imageName);
        return response()->json(['image_url' => $imageUrl], 200, [], JSON_UNESCAPED_SLASHES);
    } catch (\Exception $e) {
        return response('Something went wrong: ' . $e->getMessage(), 500);
    }
}

}
