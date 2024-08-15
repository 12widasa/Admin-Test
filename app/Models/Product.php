<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 
        'foto',
        'stok_sekarang',
    ];

    public function inputStocks()
    {
        return $this->hasMany(InputStock::class);
    }

    public function formSales()
    {
        return $this->hasMany(FormSales::class);
    }
}