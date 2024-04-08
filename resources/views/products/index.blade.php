{{-- Hiển thị danh sách sản phẩm --}}

@extends('adminlte::page') {{-- Thay đổi 'layouts.admin' thành đường dẫn đúng của layout AdminLTE của bạn --}}

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh Sách Sản Phẩm</h3>
                    <div class="card-tools">
                        <a href="{{ route('products.create') }}" class="btn btn-success">Thêm Sản Phẩm Mới</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }} $</td>
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Xem</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Sửa</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
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
