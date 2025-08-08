<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Printer;
use App\Models\PrinterType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PrinterController extends Controller
{
    public function index()
    {
       $printers = Printer::with(['printerType', 'registeredUser'])
    ->where('registered_by', Auth::id())
    ->orderBy('created_at', 'desc')
    ->get();

        $printerTypes = PrinterType::orderBy('created_at', 'desc')->get();

        return view('printer.printers', compact('printers', 'printerTypes'));
    }

    public function create()
    {
        $printerTypes = PrinterType::all();
        return view('printer.printers-create', compact('printerTypes'));
    }

    public function store(Request $request)
{
    $request->validate([
        'printer_type_id' => 'required|exists:printer_types,id', // ✅ Fixed here
        'mac_address' => [
            'required',
            'regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
            Rule::unique('printers')->where(function ($query) {
                return $query->where('registered_by', Auth::id());
            }),
        ],
        'model' => 'required|string|max:255',
        'display_name' => 'required|string|max:255',
    ], [
        'mac_address.unique' => 'This MAC address is already registered by you.',
    ]);

    Printer::create([
        'printer_type_id' => $request->printer_type_id,
        'mac_address' => $request->mac_address,
        'model' => $request->model,
        'display_name' => $request->display_name,
        'registered_by' => Auth::id(),
        'registration_date' => now()->toDateString(),
    ]);

    return redirect()->route('printers.index')->with('success', 'Printer added successfully.');
}

    public function edit($id)
    {
        $printer = Printer::findOrFail($id);
        $printerTypes = PrinterType::all();

        return view('printer.printers-create', compact('printer', 'printerTypes'));
    }

    public function update(Request $request, $id)
    {
        $printer = Printer::findOrFail($id);

        $request->validate([
            'printer_type_id' => 'required|exists:printer_types,id',
            'mac_address' => [
                'required',
                'regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
                Rule::unique('printers')
                    ->ignore($printer->id)
                    ->where(function ($query) {
                        return $query->where('registered_by', Auth::id());
                    }),
            ],
            'model' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
        ], [
            'mac_address.unique' => 'This MAC address is already registered by you.',
            'printer_type_id.exists' => 'Invalid printer type selected.',
        ]);

        $printer->update([
            'printer_type_id' => $request->printer_type_id,
            'mac_address' => $request->mac_address,
            'model' => $request->model,
            'display_name' => $request->display_name,
            'registration_date' => now()->toDateString(),
        ]);

        return redirect()->route('printers.index')->with('success', 'Printer updated successfully.');
    }

    public function destroy($id)
    {
        $printer = Printer::findOrFail($id);
        $printer->delete();

        return redirect()->route('printers.index')->with('success', 'Printer deleted successfully.');
    }
}
