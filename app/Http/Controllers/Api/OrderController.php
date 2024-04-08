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
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id'
        ]);

        DB::beginTransaction();
        try {
            $order = new Order;
            $order->product_id = $request->product_id;
            $order->user_id = $request->user_id;
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
