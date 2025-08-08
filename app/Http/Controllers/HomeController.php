<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Printer;
use App\Models\PrinterType;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        // ✅ Use Auth::id() instead of Auth::user()->name
        $printerCount = Printer::where('registered_by', Auth::id())->count();

        $printerTypeCount = PrinterType::count();

        return view('dashbord', compact('printerCount', 'printerTypeCount'));
    }

    public function printerType()
    {
        return view('printer.printer-type');
    }
}
