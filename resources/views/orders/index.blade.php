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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Số Điện Thoại</th>
                                <th>Sản Phẩm</th>
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
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
            @if ($order->status == 'chờ xác nhận')
                <a href="{{ route('orders.complete', $order->id) }}" class="btn btn-success">Hoàn Thành</a>
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
@endsection