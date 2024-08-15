<?php

namespace App\Http\Controllers;

use App\Models\InputStock;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class InputStockProductController extends Controller
{
    public function create(array $data): Model
    {
        $inputStock = InputStock::create($data);
        $this->updateProductStock($inputStock);
        return $inputStock;
    }

    public function update(InputStock $inputStock, array $data): Model
    {
        $oldQuantity = $inputStock->penambahan_stok;
        $inputStock->update($data);
        $this->updateProductStock($inputStock, $oldQuantity);
        return $inputStock;
    }

    public function delete(InputStock $inputStock): ?bool
    {
        $this->updateProductStock($inputStock, $inputStock->penambahan_stok, true);
        return $inputStock->delete();
    }

    private function updateProductStock(InputStock $inputStock, $oldQuantity = 0, $isDeleting = false)
    {
        $product = Product::findOrFail($inputStock->product_id);
        if ($isDeleting) {
            $product->stok_sekarang -= $oldQuantity;
        } else {
            $product->stok_sekarang += $inputStock->penambahan_stok - $oldQuantity;
        }
        $product->save();
    }
}