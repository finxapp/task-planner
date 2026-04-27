@extends('layouts.app')

@section('content')

    <h2 class="text-2xl font-bold mb-4">Published Posts</h2>

    <div class="grid grid-cols-3 gap-4">

        @forelse($tasks as $task)

            <a href="/published/{{ $task->id }}">
                <x-card>
                    <h3 class="text-lg font-bold">{{ $task->title }}</h3>

                    <p class="text-gray-600 mt-2">
                        {!! Str::limit(strip_tags($task->description), 120) !!}
                    </p>

                    <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
                        <span>By {{ $task->user->name }}</span>
                        <span>{{ $task->created_at->format('M d, Y') }}</span>
                    </div>

                </x-card>
            </a>

            @empty

            <x-empty-state>
            No published posts yet
            </x-empty-state>

        @endforelse

    </div>

@endsection
