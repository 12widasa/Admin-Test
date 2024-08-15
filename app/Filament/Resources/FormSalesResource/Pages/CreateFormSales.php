<?php

namespace App\Filament\Resources\FormSalesResource\Pages;

use App\Filament\Resources\FormSalesResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateFormSales extends CreateRecord
{
    protected static string $resource = FormSalesResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $product = \App\Models\Product::lockForUpdate()->findOrFail($data['product_id']);

            if ($product->stok_sekarang < $data['stok_terjual']) {
                $this->halt('Stok tidak mencukupi');
            }

            $product->decrement('stok_sekarang', $data['stok_terjual']);

            return \App\Models\FormSales::create([
                'product_id' => $data['product_id'],
                'user_id' => auth()->id(),
                'stok_terjual' => $data['stok_terjual'],
                'tanggal_input' => now(),
            ]);
        });
    }
}