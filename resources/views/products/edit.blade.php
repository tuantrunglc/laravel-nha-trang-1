{{-- resources/views/products/edit.blade.php --}}

@extends('adminlte::page')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm Sản Phẩm Mới</h3>
                </div>
                <form action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" method="PUT">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Tên Sản Phẩm</label>
                            <input type="text" class="form-control" id="name" name="name"   value="{{ $product->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá Sản Phẩm</label>
                            <input type="number" class="form-control" id="price" name="price"  value="{{ $product->price }}" required>
                        </div>
                        <div class="form-group">
    <label for="image">Ảnh Sản Phẩm</label>
    <input type="file" class="form-control" id="image" name="image">
</div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection