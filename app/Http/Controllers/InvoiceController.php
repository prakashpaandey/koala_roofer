<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invoice;
use App\Models\Tradie;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Invoice::with('tradie')->latest();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('invoice_number', 'like', "%{$search}%")
                  ->orWhereHas('tradie', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        $invoices = $query->paginate(10);

        if ($request->ajax()) {
            return view('invoices.partials.list', compact('invoices'))->render();
        }

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tradies = Tradie::orderBy('name')->get();
        $defaultTaxRate = Setting::get('default_tax_rate', 0);
        return view('invoices.create', compact('tradies', 'defaultTaxRate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|unique:invoices,invoice_number',
            'date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string',
            'tax_percentage' => 'required|numeric|min:0|max:100',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.amount' => 'required|numeric|min:0',
        ]);

        // Calculate Subtotal
        $subtotal = collect($request->items)->sum('amount');
        
        // Calculate Tax Amount
        $taxPercentage = $validated['tax_percentage'];
        $taxAmount = ($subtotal * $taxPercentage) / 100;
        
        // Total Amount (Subtotal + Tax)
        $totalAmount = $subtotal + $taxAmount;

        $validated['tax_amount'] = $taxAmount;
        $validated['amount'] = $totalAmount;

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
        
        return $pdf->download('Invoice-' . str_replace('#', '', $invoice->invoice_number) . '.pdf');
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
