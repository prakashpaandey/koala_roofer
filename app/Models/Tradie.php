<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tradie extends Model
{
    protected $fillable = [
        'name',
        'contact_number',
        'address',
        'photo_path',
        'passport_path',
        'additional_document_path',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
