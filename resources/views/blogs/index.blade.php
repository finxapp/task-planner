@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    
    <div class="flex items-center gap-4"> 
        <h2 class="text-2xl font-bold text-green-600">Blogs</h2>
        <div>
            @auth  
            <x-badge type="info">
                {{ ucfirst(auth()->user()->highestRole()) }}
            </x-badge>
                @else
                <x-badge type="warning">
                    Guest
                </x-badge>
            @endauth
        </div>
    </div>
       
        <div class="flex gap-2">
            @role('author')
                <a href="/my-blogs">
                    <x-button variant="primaryalt">
                        My Blogs
                    </x-button>
                </a>
    
                <a href="/blogs/create">
                    <x-button variant="primary">
                        Add Blog
                    </x-button>
                </a>
            @endrole
        </div>
    
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">

        @forelse($blogs as $blog)
            <a href="/blogs/{{ $blog->id }}">
                <x-card>
                    <h3 class="font-bold">
                    {{ $blog->title }}
                    </h3>

                    <p class="text-sm text-gray-500">
                    By {{ $blog->user->name }}
                    </p>

                    <p class="mt-2">
                    {{ Str::limit(strip_tags($blog->content), 100) }}
                    </p>
                </x-card>
            </a>

            @empty

            <x-empty-state>
            No Blog post yet
            </x-empty-state>

        @endforelse

    </div>
@endsection