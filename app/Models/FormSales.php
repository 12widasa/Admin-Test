<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSales extends Model
{
    // use HasFactory;

    // protected $fillable = [
    //     'product_id',
    //     'user_id',
    //     'stok_terjual',
    //     'tanggal_input',
    // ];

    // protected $casts = [
    //     'tanggal_input' => 'date',
    // ];

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'stok_terjual',
        'tanggal_input',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}