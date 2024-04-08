@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to your Admin dashboard!</p>
@stop
<script>
function markAsRead(notificationId) {
    fetch('/mark-notification-as-read/' + notificationId, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: notificationId })
    }).then(response => {
        location.reload(); // Reload để cập nhật số lượng thông báo
    });
}
</script>