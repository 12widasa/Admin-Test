<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormSales;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AddProductController extends Controller
{

    public function addPenjualan(Request $request)
    {
        // Validasi input
        // dd($request->all());
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stok_terjual' => 'required|integer|min:1',
        ]);

        // Gunakan user yang sedang login
        $user = $request->user();

        // Cek apakah user memiliki role sales
        if ($user->role !== User::ROLE_SALES) {
            return response()->json(['error' => 'User tidak memiliki otoritas sales'], 403);
        }

        try {
            DB::beginTransaction();

            // Dapatkan produk dan kurangi stok
            $product = Product::lockForUpdate()->findOrFail($request->product_id);

            if ($product->stok_sekarang < $request->stok_terjual) {
                throw new \Exception('Stok tidak mencukupi');
            }

            $product->decrement('stok_sekarang', $request->stok_terjual);

            // Buat catatan penjualan
            $formSales = FormSales::create([
                'product_id' => $request->product_id,
                'user_id' => $user->id,
                'stok_terjual' => $request->stok_terjual,
                'tanggal_input' => now(),
            ]);

            DB::commit();

            return response()->json(['message' => 'Penjualan berhasil ditambahkan', 'data' => $formSales], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}