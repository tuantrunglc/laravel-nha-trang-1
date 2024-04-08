<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user', 'product')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function complete($id)
{
    $order = Order::findOrFail($id);
    DB::transaction(function () use ($order) {
        if ($order->status == 'chờ xác nhận') {
            $order->status = 'hoàn thành';
            $order->save();

            // Trừ tiền từ ví của người dùng
            $user = $order->user; // Đảm bảo bạn đã thiết lập mối quan hệ trong model Order
            $level = $user->level; // Giả sử mối quan hệ level đã được thiết lập trong User model
            $incomeMultiplier = Level::where('vip_level', $level)->first()->income ?? 0;
        
        // Tính toán và cập nhật thu nhập dựa vào level
            $additionalIncome = $order->product->price * $incomeMultiplier;
            $user->wallet += $additionalIncome;
            $user->save();
        }
    });

    return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được cập nhật thành hoàn thành.');
}
}
