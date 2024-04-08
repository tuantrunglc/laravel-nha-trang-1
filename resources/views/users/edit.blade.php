@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="phone" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
            </div>
            <div class="form-group">
                <label for="wallet">Wallet:</label>
                <input type="wallet" class="form-control" id="wallet" name="wallet" value="{{ $user->wallet }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@stop