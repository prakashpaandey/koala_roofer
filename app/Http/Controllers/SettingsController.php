<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function updateTaxRate(Request $request)
    {
        $request->validate([
            'rate' => 'required|numeric|min:0|max:100',
        ]);

        Setting::set('default_tax_rate', $request->rate);

        return response()->json([
            'success' => true,
            'message' => 'Default tax rate updated successfully!'
        ]);
    }
}
