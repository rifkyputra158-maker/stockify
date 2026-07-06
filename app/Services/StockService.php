<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockService
{
    public function stockIn(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);
            $product->increment('stock', $data['quantity']);

            return StockTransaction::create([
                'product_id' => $data['product_id'],
                'user_id' => auth()->id(),
                'type' => 'in',
                'quantity' => $data['quantity'],
                'date' => $data['date'],
                'status' => 'confirmed',
                'notes' => $data['notes'] ?? null,
            ]);
        });
    }

    public function stockOut(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);

            if ($product->stock < $data['quantity']) {
                throw ValidationException::withMessages([
                    'quantity' => 'Stok tidak mencukupi. Sisa stok: ' . $product->stock,
                ]);
            }

            $product->decrement('stock', $data['quantity']);

            return StockTransaction::create([
                'product_id' => $data['product_id'],
                'user_id' => auth()->id(),
                'type' => 'out',
                'quantity' => $data['quantity'],
                'date' => $data['date'],
                'status' => 'confirmed',
                'notes' => $data['notes'] ?? null,
            ]);
        });
    }
}