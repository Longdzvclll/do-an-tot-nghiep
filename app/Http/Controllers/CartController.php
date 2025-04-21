<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::find($request->input('product_id'));

        if ($product) {
            $mainImage = $product->mainImage ? $product->mainImage->image_name : null;

            \Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->input('quantity'), 'attributes' => [
                    'slug' => $product->slug,
                    'image' => $mainImage,
                ],
            ]);

            // Kiểm tra nếu là yêu cầu AJAX
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Thêm sản phẩm vào giỏ hàng thành công!']);
            }

            return redirect()->back()->with('success', 'Product added to cart!');
        }

        if ($request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Product not found!']);
        }

        return redirect()->back()->with('error', 'Product not found!');

    }

    public function viewCart()
    {
        $cartItems = \Cart::getContent();
        return view('frontend.cart.view', compact('cartItems'));
    }

    public function update(Request $request)
    {
        $ids = $request->input('ids');
        $quantities = $request->input('quantities');

        foreach ($ids as $index => $id) {
            \Cart::update($id, [
                'quantity' => [
                    'relative' => false,
                    'value' => $quantities[$index],
                ],
            ]);
        }

        return redirect()->route('cart.view')->with('success', 'Giỏ hàng đã được cập nhật.');
    }

    public function remove(Request $request)
    {
        \Cart::remove($request->id);
        return response()->json(['success' => true]);
    }


}
