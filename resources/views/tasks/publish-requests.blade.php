@extends('layouts.app')

@section('content')

    <h2 class="text-2xl font-bold mb-4">Publish Requests</h2>

    <div class="grid gap-4 grid-cols-1 sm:grid-cols-3">

        @foreach($tasks as $task)

        <x-card>

            <h3 class="font-bold">{{ $task->title }}</h3>

            <x-badge type="warning">
            {{ strtoupper($task->status) }}
            </x-badge>

            <p class="mt-2">
            {{ Str::limit(strip_tags($task->description),50) }}
            </p>

            <div class="flex gap-2 mt-3">

                @if($task->status === 'pending')
                <form method="POST" action="/tasks/{{ $task->id }}/review">
                @csrf
                    <x-button>Mark Review</x-button>
                </form>
                @endif

                @if($task->status === 'review')
                <form method="POST" action="/tasks/{{ $task->id }}/approve">
                @csrf
                    <x-button variant="primary">Approve</x-button>
                </form>
                @endif
            </div>
        </x-card>
        @endforeach

    </div>

@endsection