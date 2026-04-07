<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'tradie_id',
        'invoice_number',
        'date',
        'work_description',
        'amount',
    ];

    public function tradie()
    {
        return $this->belongsTo(Tradie::class);
    }
}
