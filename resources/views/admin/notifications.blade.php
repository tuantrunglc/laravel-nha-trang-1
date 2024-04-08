@extends('adminlte::page')

@section('title', 'Notifications')

@section('content_header')
    <h1>Notifications</h1>
@endsection

@section('content')
<div class="container">
    @if($notifications->isEmpty())
        <p class="text-center">No new notifications.</p>
    @else
        <div class="list-group">
            @foreach($notifications as $notification)
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $notification->type }}</h5>
                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">{{ $notification->message }}</p>
                    <small class="text-muted">Click to mark as read</small>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('js')
<script>
    document.querySelectorAll('.list-group-item').forEach(item => {
        item.addEventListener('click', function() {
            const notificationId = this.dataset.notificationId; // Make sure to add `data-notification-id` in your a tag if needed
            fetch(`/mark-notification-as-read/${notificationId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: notificationId })
            }).then(response => {
                this.classList.add('list-group-item-light'); // Change background or remove item
            }).catch(error => console.error('Error:', error));
        });
    });
</script>
@endsection