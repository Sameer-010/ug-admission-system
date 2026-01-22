@extends('layouts.app')

@section('content')

<div class="container py-4">

    <h3 class="fw-bold mb-3">Notifications</h3>

    <form action="{{ route('notifications.read.all') }}" method="GET" class="mb-3">
        <button class="btn btn-primary btn-sm">Mark All as Read</button>
    </form>

    <div class="list-group shadow-sm">

        @forelse($notifications as $noti)
            <a href="{{ route('notifications.read.single', $noti->id) }}"
               class="list-group-item list-group-item-action 
                    {{ $noti->is_read ? '' : 'fw-bold bg-light' }}">

                <div class="d-flex justify-content-between">
                    <h6 class="mb-1">{{ $noti->title }}</h6>
                    <small>{{ $noti->created_at->diffForHumans() }}</small>
                </div>

                <p class="mb-1">{{ $noti->message }}</p>

            </a>
        @empty
            <p class="text-muted text-center py-4">No notifications found.</p>
        @endforelse

    </div>

    <div class="mt-3">
        {{ $notifications->links() }}
    </div>

</div>

@endsection
