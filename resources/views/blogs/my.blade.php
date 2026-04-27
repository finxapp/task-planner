@extends('layouts.app')

@section('content')

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-2xl font-bold">
        My Blogs
        </h2>

        @role('author')
        <a href="/blogs/create">
            <x-button>Add Blog</x-button>
        </a>
        @endrole

    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">

        @foreach($blogs as $blog)
            <a href="/blogs/{{ $blog->id }}">
                <x-card>

                <h3 class="font-bold">
                {{ $blog->title }}
                </h3>

                <x-badge type="{{ $blog->status == 'approved' ? 'success' : ($blog->status == 'pending' ? 'warning' : 'info') }}">
                {{ strtoupper($blog->status) }}
                </x-badge>

                <p class="mt-2">
                {{ Str::limit(strip_tags($blog->content), 100) }}
                </p>

                </x-card>
            </a>

        @endforeach

    </div>

@endsection