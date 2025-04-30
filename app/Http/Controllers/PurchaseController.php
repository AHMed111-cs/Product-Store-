<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Auth::user()
            ->purchases()
            ->with('product')
            ->latest()
            ->get();

        return view('purchases.index', compact('purchases'));
    }

    public function store(Request $request, Product $product)
    {
        $user = Auth::user();

        if (!$user->hasRole('customer')) {
            return redirect()->back()->with('error', 'Only customers can make purchases.');
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $quantity = $validated['quantity'];

        if (!$product->isAvailableForPurchase($quantity)) {
            return redirect()->back()->with('error', 'The requested quantity is not available.');
        }

        if (!$user->hasSufficientBalance($product, $quantity)) {
            return redirect()->back()->with('error', 'Insufficient balance to complete the purchase.');
        }

        $purchase = $user->purchaseProduct($product, $quantity);

        if ($purchase) {
            return redirect()->route('purchases.index')->with('success', 'Purchase completed successfully.');
        }

        return redirect()->back()->with('error', 'Purchase failed. Please try again.');
    }
}