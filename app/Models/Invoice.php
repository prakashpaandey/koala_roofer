<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'tradie_id', // Optional now
        'customer_name',
        'customer_abn',
        'customer_address',
        'invoice_number',
        'date',
        'work_description', // Optional
        'items',
        'amount',
        'tax_percentage',
        'tax_amount',
    ];

    protected $casts = [
        'items' => 'array',
        'date' => 'date',
    ];

    public function tradie()
    {
        return $this->belongsTo(Tradie::class);
    }
}
