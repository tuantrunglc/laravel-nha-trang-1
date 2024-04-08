<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'product_id' => 'required',
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
            event(new \App\Events\NewOrderEvent($order));

            DB::commit();

            return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function index(Request $request)
    {
        $user = $request->user(); // Lấy thông tin người dùng từ token
        $orders = $user->orders()->with('product')->get();
        // Giả sử bạn đã thiết lập mối quan hệ 'orders' trong model User

        return response()->json([
            'message' => 'Retrieved successfully',
            'orders' => $orders
        ]);
    }
}
