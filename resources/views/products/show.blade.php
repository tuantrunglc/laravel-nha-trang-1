{{-- resources/views/products/show.blade.php --}}

@extends('adminlte::page')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="d-inline-block d-sm-none">{{ $product->name }}</h3>
                            <div class="col-12">
                            @if ($product->image)
    <img src="{{ asset('storage/'.$product->image) }}" width="100" height="100">
@endif
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3">{{ $product->name }}</h3>
                            <p>{{ $product->description }}</p>
                            <hr>
                            <h4>Giá ${{ $product->price }}</h4>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg btn-flat">
                            <i class="fas fa-undo fa-lg mr-2"></i>
                            Quay Lại Danh Sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
