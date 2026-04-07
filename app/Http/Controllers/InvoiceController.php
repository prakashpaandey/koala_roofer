<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invoice;
use App\Models\Tradie;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('tradie')->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tradies = Tradie::orderBy('name')->get();
        return view('invoices.create', compact('tradies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tradie_id' => 'required|exists:tradies,id',
            'invoice_number' => 'required|string|unique:invoices,invoice_number',
            'date' => 'required|date',
            'work_description' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        Invoice::create($validated);

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    /**
     * PDF Download logic.
     */
    public function download(Invoice $invoice)
    {
        $invoice->load('tradie');
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
        
        return $pdf->download('Invoice-' . $invoice->invoice_number . '.pdf');
    }

    /**
     * Not using edit for now as per minimal requirements, but could be added.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Not using update for now.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
