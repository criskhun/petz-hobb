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
        return view('backend.pos.index', compact('products'));
    }

    public function addProduct(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        POS::create(['product_id' => $product->id]);
    
        // Get the updated selected products HTML
        $selectedProducts = POS::with('product')->get();
        $html = view('backend.pos.selected_products', compact('selectedProducts'))->render();
    
        return response()->json(['html' => $html]);
    }
    
    public function removeProduct(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        POS::where('product_id', $product->id)->delete();
    
        // Get the updated selected products HTML
        $selectedProducts = POS::with('product')->get();
        $html = view('backend.pos.selected_products', compact('selectedProducts'))->render();
    
        return response()->json(['html' => $html]);
    }
    
    public function printReceipt(Request $request)
    {
        // Retrieve the selected products and calculate the total amount
        $selectedProducts = POS::with('product')->get();
        $totalAmount = $selectedProducts->sum('product.price');
    
        // Get the VAT, discount, and amount paid from the request
        $vat = $request->input('vat');
        $discount = $request->input('discount');
        $amountPaid = $request->input('amount_paid');
    
        // Process the receipt printing logic here
        // ...
    
        return response()->json(['message' => 'Receipt printed!']);
    }
    public function showList()
    {
    $selectedProducts = POS::with('product')->get();
    return view('backend.pos.index', compact('selectedProducts'));
    }
}
