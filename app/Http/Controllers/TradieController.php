<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tradie;
use Illuminate\Support\Facades\Storage;

class TradieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tradie::latest();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('contact_number', 'like', '%' . $searchTerm . '%')
                  ->orWhere('address', 'like', '%' . $searchTerm . '%');
            });
        }

        $tradies = $query->paginate(10)->withQueryString();
        
        if ($request->ajax()) {
            return view('tradies.partials.list', compact('tradies'))->render();
        }

        return view('tradies.index', compact('tradies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tradies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'passport' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:5120',
            'additional_document' => 'nullable|file|mimes:pdf,jpg,png,jpeg,doc,docx|max:10240',
        ]);

        $data = $validated;

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('tradies/photos', 'public');
        }
        if ($request->hasFile('passport')) {
            $data['passport_path'] = $request->file('passport')->store('tradies/passports', 'public');
        }
        if ($request->hasFile('additional_document')) {
            $data['additional_document_path'] = $request->file('additional_document')->store('tradies/documents', 'public');
        }

        Tradie::create($data);

        return redirect()->route('tradies.index')->with('success', 'Tradie added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tradie $tradie)
    {
        return view('tradies.show', compact('tradie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tradie $tradie)
    {
        return view('tradies.edit', compact('tradie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tradie $tradie)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'passport' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:5120',
            'additional_document' => 'nullable|file|mimes:pdf,jpg,png,jpeg,doc,docx|max:10240',
        ]);

        $data = $validated;

        if ($request->hasFile('photo')) {
            if ($tradie->photo_path) Storage::disk('public')->delete($tradie->photo_path);
            $data['photo_path'] = $request->file('photo')->store('tradies/photos', 'public');
        }
        if ($request->hasFile('passport')) {
            if ($tradie->passport_path) Storage::disk('public')->delete($tradie->passport_path);
            $data['passport_path'] = $request->file('passport')->store('tradies/passports', 'public');
        }
        if ($request->hasFile('additional_document')) {
            if ($tradie->additional_document_path) Storage::disk('public')->delete($tradie->additional_document_path);
            $data['additional_document_path'] = $request->file('additional_document')->store('tradies/documents', 'public');
        }

        $tradie->update($data);

        return redirect()->route('tradies.index')->with('success', 'Tradie updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tradie $tradie)
    {
        if ($tradie->photo_path) Storage::disk('public')->delete($tradie->photo_path);
        if ($tradie->passport_path) Storage::disk('public')->delete($tradie->passport_path);
        if ($tradie->additional_document_path) Storage::disk('public')->delete($tradie->additional_document_path);

        $tradie->delete();

        return redirect()->route('tradies.index')->with('success', 'Tradie deleted successfully.');
    }
}
