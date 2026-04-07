<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tradie;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index()
    {
        $tradieCount = Tradie::count();
        $invoiceCount = Invoice::count();

        return view('dashboard', compact('tradieCount', 'invoiceCount'));
    }
}
