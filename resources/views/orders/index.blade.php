@extends('adminlte::page')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh Sách Đơn Hàng</h3>
                </div>
                <div class="card-body">
                <form action="{{ route('orders.index') }}" method="GET" class="form-inline">
    <div class="form-group mb-2">
        <label for="phone" class="sr-only">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Search by phone" value="{{ request('phone') }}">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Search</button>
</form>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Số Điện Thoại</th>
                                <th>Sản Phẩm</th>
                                <th>Giá tiền</th>
                                <th>Trạng Thái</th>
                                <th>Thời Gian</th>
                                <th>Xác nhận đơn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->phone }}</td>
                                <td><img src="{{ asset('storage/'.$order->product->image) }}" width="100"></td>
                                <td>{{ $order->total_price }} $</td>
                                <td class="{{ $order->status == 'chờ xác nhận' ? 'waiting-confirmation' : ($order->status == 'từ chối' ? 'denied' : 'other-status') }}">
                                    {{ $order->status }}
                                </td>                                
                                <td>{{ $order->created_at }}</td>
                                <td>
                                @if ($order->status == 'chờ xác nhận')
            <a href="{{ route('orders.complete', $order->id) }}" class="btn btn-success">Hoàn Thành</a>
            <form action="{{ route('orders.reject', $order->id) }}" method="POST" style="display: inline-block;">
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this order and refund the amount?');">Từ Chối</button>
            </form>
        @endif
        </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .waiting-confirmation {
        background-color: #f0f0f0; /* màu xám nền */
        border: 1px solid #d3d3d3; /* viền màu xám nhạt */
        padding: 8px; /* thêm padding cho khoảng cách */
        border-radius: 4px; /* bo góc viền */
    }
    .other-status {
        border: 1px solid #007bff; /* viền màu xanh */
        padding: 8px; /* thêm padding cho khoảng cách */
        border-radius: 4px; /* bo góc viền */
    }
    .denied {
        border: 1px solid #dc3545; /* viền màu đỏ */
        padding: 8px; /* thêm padding cho khoảng cách */
        border-radius: 4px; /* bo góc viền */
    }
</style>

@endsection