<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Printer;
use Illuminate\Support\Facades\Http;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Str;
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
    public function getSCImage(Request $request)
    {
        try {
            $url = $request->query('url');
            // $response = Http::get('https://dev.vrlapps.com/corevrl/core_app_booking/bk_gcprint_collection_landscap.aspx');
            $response = Http::get($url);
            if ($response->failed()) {
                return response('Failed to fetch URL', 500);
            }

            $html = $response->body();
            $imageName = 'table-image-mobile-' . Str::random(10) . '.png';
            $imagePath = public_path($imageName);

                Browsershot::html($html)
                    ->setNodeBinary('/usr/bin/node')
                    ->setNpmBinary('/usr/bin/npm')
                    ->setChromePath('/usr/local/bin/chromium-browser')
                    ->addChromiumArguments([
                        '--no-sandbox',
                        '--disable-setuid-sandbox',
                        '--headless=new',
                        '--user-data-dir=/tmp/chrome-user-data',
                ])
                ->windowSize(700, 300)
                ->deviceScaleFactor(2)
                ->waitUntilNetworkIdle()
                ->save($imagePath);

            $imageUrl = url($imageName);
            // $imageData = file_get_contents($imagePath);
            // $base64 = base64_encode($imageData);
            // $imageInfo = getimagesize($imagePath);
            // $base64Image = 'data:' . $imageInfo['mime'] . ';base64,' . $base64;

            return response()->json(['image_url' => $imageName], 200, [], JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return response('Something went wrong: ' . $e->getMessage(), 500);
        }
    }

}
