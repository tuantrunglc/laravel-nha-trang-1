<!-- resources/views/levels/edit.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Edit Level</h1>
    <form method="POST" action="{{ route('levels.update', $level->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="vip_level">VIP Level</label>
            <input type="number" class="form-control" id="vip_level" name="vip_level" value="{{ $level->vip_level }}" required>
        </div>
        <div class="form-group">
            <label for="income">Income Multiplier</label>
            <input type="text" class="form-control" id="income" name="income" value="{{ $level->income }}" required>
        </div>
        <div class="form-group">
            <label for="minimum_amount">Minimum Amount</label>
            <input type="text" class="form-control" id="minimum_amount" name="minimum_amount" value="{{ $level->minimum_amount }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
