<?php

namespace App\Http\Controllers;

use App\Models\POS;
use App\Models\Product;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('cash_register.index', compact('products'));
    }

    public function addProduct(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        CashRegister::create(['product_id' => $product->id]);
        return redirect()->back()->with('success', 'Product added successfully.');
    }

    public function removeProduct(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        CashRegister::where('product_id', $product->id)->delete();
        return redirect()->back()->with('success', 'Product removed successfully.');
    }

    public function showList()
    {
        $products = CashRegister::with('product')->get();
        $totalAmount = CashRegister::getTotalAmount();
        return view('pos.list', compact('products', 'totalAmount'));
    }
}
