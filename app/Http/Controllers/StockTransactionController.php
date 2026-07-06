<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockInRequest;
use App\Http\Requests\StockOutRequest;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Services\StockService;
use Illuminate\Validation\ValidationException;

class StockTransactionController extends Controller
{
    public function __construct(protected StockService $stockService) {}

    public function index()
    {
        $transactions = StockTransaction::with(['product', 'user'])->latest('date')->paginate(15);
        $products = Product::all();
        return view('stock-transactions.index', compact('transactions', 'products'));
    }

    public function storeIn(StockInRequest $request)
    {
        $this->stockService->stockIn($request->validated());
        return redirect()->route('stock-transactions.index')->with('success', 'Barang masuk berhasil dicatat.');
    }

    public function storeOut(StockOutRequest $request)
    {
        try {
            $this->stockService->stockOut($request->validated());
            return redirect()->route('stock-transactions.index')->with('success', 'Barang keluar berhasil dicatat.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
}