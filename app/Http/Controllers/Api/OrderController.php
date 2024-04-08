<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        $user = $request->user(); // Lấy thông tin người dùng đã xác thực
        $product = Product::findOrFail($request->product_id);

        DB::beginTransaction();
        try {
            $order = new Order;
            $order->user_id = $user->id;
            $order->product_id = $product->id;
            $order->total_price = $product->price; // Giả sử total_price bằng giá sản phẩm
            $order->save();
            // Giả sử bạn có một hệ thống thông báo trong AdminLTE
            // Gửi thông báo đến Admin
            event(new \App\Events\NewOrderEvent($order));

            DB::commit();

            return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
