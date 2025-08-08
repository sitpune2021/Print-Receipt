<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\PrinterType;

class PrinterTypeController extends Controller
{
    public function index()
    {
        $printerTypes = PrinterType::orderBy('created_at', 'desc')->get();
        return view('printer.printer-type', compact('printerTypes'));
    }

    public function create()
    {
        return view('printer.printer-type-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:printer_types,name',
            'protocol' => 'required|string|max:255',
            'description' => 'nullable|string|max:250',

        ], [
            'name.required' => 'Printer Type Name is required.',
            'name.unique'   => 'Printer Type Name must be unique.',
            'protocol.required' => 'Communication Protocol is required.',
            'description.max' => 'Description cannot exceed 250 characters.',
        ]);

        $validated['status'] = $request->has('status') ? 1 : 0;

        PrinterType::create($validated);

        return redirect()->route('printer.printer-type')->with('success', 'Printer Type added successfully!');
    }

    public function edit($id)
    {
        $editData = PrinterType::findOrFail($id);
        return view('printer.printer-type-create', compact('editData'));
    }

    public function update(Request $request, $id)
    {
        $printerType = PrinterType::findOrFail($id);

        $request->validate([
           'name' => 'required|string|max:255',
            'protocol' => 'required|string|max:255',
            'description' => 'nullable|string|max:250',
        ], [
            'name.required' => 'Printer Type Name is required.',

            'protocol.required' => 'Communication Protocol is required.',
            'description.max' => 'Description cannot exceed 250 characters.',
        ]);

        $printerType->update([
            'name' => $request->name,
            'protocol' => $request->protocol,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0,
        ]);

       return redirect()->route('printer.printer-type')->with('success', 'Printer Type updated successfully!');
    }

    public function destroy($id)
    {
        $printerType = PrinterType::findOrFail($id);
        $printerType->delete();

        return redirect()->route('printer.printer-type')->with('success', 'Printer Type deleted successfully!');
    }
}
