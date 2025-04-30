<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductLikeController extends Controller
{
    public function toggleLike(Product $product)
    {
        $user = Auth::user();

        // ✅ تحقق من صلاحية الدور
        if (!$user->hasRole('customer')) {
            return redirect()->back()->with('error', 'Only customers can like products.');
        }

        // ✅ تحقق من الشراء المسبق
        if (!$product->hasBeenPurchasedBy($user)) {
            return redirect()->back()->with('error', 'You can only like products you have purchased.');
        }

        // ✅ إلغاء الإعجاب إذا كان موجوداً
        if ($product->isLikedBy($user)) {
            $product->likes()->where('user_id', $user->id)->delete();
            return redirect()->back()->with('success', 'You have unliked the product.');
        }

        // ✅ إنشاء إعجاب جديد
        $product->likes()->create([
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Product liked successfully.');
    }
}
