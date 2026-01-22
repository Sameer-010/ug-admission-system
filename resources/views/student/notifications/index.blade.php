@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Notifications</h4>

        @if($unreadCount > 0)
        <form action="{{ route('student.notifications.readAll') }}" method="POST">
            @csrf
            <button class="btn btn-primary btn-sm">Mark All as Read</button>
        </form>
        @endif
    </div>

    @forelse($notifications as $note)
        <div class="card shadow-sm mb-3 {{ $note->is_read ? '' : 'border-primary' }}">
            <div class="card-body">
                <h5 class="mb-1">{{ $note->title }}</h5>
                <p class="text-muted small">{{ $note->created_at->diffForHumans() }}</p>
                <p>{{ $note->message }}</p>

                @if(!$note->is_read)
                    <form action="{{ route('student.notifications.read', $note->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-success btn-sm">
                            Mark as Read
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p class="text-muted text-center">No notifications found.</p>
    @endforelse

    <div class="mt-3">
        {{ $notifications->links() }}
    </div>
</div>
@endsection
