<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'penambahan_stok',
        'tanggal_input',
    ];

    protected $casts = [
        'tanggal_input' => 'datetime',
    ];

public function product()
    {
        return $this->belongsTo(Product::class);
    }
}