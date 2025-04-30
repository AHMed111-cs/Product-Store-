<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductHoldController extends Controller
{
    public function toggleHold(Product $product)
    {
        Gate::authorize('hold_products');

        $product->update([
            'hold' => !$product->hold
        ]);

        $status = $product->hold ? 'placed on hold' : 'released from hold';

        return redirect()->back()->with('success', "Product has been {$status} successfully.");
    }
}
