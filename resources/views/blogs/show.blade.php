@extends('layouts.app')

@section('content')

    <div class="max-w-3xl mx-auto">

        <h1 class="text-3xl font-bold mb-2">
        {{ $blog->title }}
        </h1>

        <p class="text-gray-500 mb-4">
        By <span class="font-semibold">{{ $blog->user->name }}</span> •
        {{ $blog->created_at->diffForHumans() }}
        </p>

        @auth
        <div>
            @if(
                $blog->user_id === auth()->id() || 
                auth()->user()->hasAnyRole(['superadmin','admin','supervisor','editor'])
            )
                <x-badge type="{{ $blog->status == 'approved' ? 'success' : ($blog->status == 'pending' ? 'warning' : 'info') }}">
                    {{ strtoupper($blog->status) }}
                </x-badge>
            @endif

            @if($blog->user_id === auth()->id() && $blog->status != 'approved')
                <a href="/blogs/{{ $blog->id }}/edit" class="ml-4 text-sm text-green-600 hover:underline">
                    Edit
                </a>
            @endif
        </div>
        @endauth

        <hr class="my-4">

        <div class="prose max-w-none">
        {!! $blog->content !!}
        </div>

    </div>

@endsection