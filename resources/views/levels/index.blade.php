<!-- resources/views/levels/index.blade.php -->
@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Levels List</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>VIP Level</th>
                <th>Income Multiplier</th>
                <th>Minimum Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($levels as $level)
            <tr>
                <td>{{ $level->vip_level }}</td>
                <td>{{ $level->income }}%</td>
                <td>{{ $level->minimum_amount }} $</td>
                <td>
                    <a href="{{ route('levels.edit', $level->id) }}" class="btn btn-info">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
