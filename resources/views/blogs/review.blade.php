@extends('layouts.app')

@section('content')

    <h2 class="text-2xl font-bold mb-6">
    Review Blogs
    </h2>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">

    @forelse($blogs as $blog)

        <x-card>

        <h3 class="font-bold">
        {{ $blog->title }}
        </h3>

        <p class="text-sm text-gray-500">
        By {{ $blog->user->name }}
        </p>

        <x-badge type="warning">
        {{ strtoupper($blog->status) }}
        </x-badge>

        <p class="mt-2">
        {{ \Illuminate\Support\Str::limit(strip_tags($blog->content),120) }}
        </p>

        <div class="flex gap-2 mt-3">

            @if($blog->status == 'pending')
                <form method="POST" action="/blogs/{{ $blog->id }}/review">
                @csrf
                    <x-button variant="secondary">
                    Mark Review
                    </x-button>
                </form>
            @endif

            @if($blog->status == 'review')
                <form method="POST" action="/blogs/{{ $blog->id }}/approve">
            @csrf
            <x-button>
            Approve
            </x-button>
            </form>

            <form method="POST" action="/blogs/{{ $blog->id }}/reject">
            @csrf
                <x-button variant="dangeralt">
                Reject
                </x-button>
            </form>
            @endif

        </div>

        </x-card>

    @empty

    <p>No review requests</p>

    @endforelse

    </div>

@endsection