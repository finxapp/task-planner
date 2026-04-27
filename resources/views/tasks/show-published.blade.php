@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <a href="/published" class="text-blue-600 hover:underline">
        ← Back to Published
    </a>

    <h1 class="text-3xl font-bold mt-4">
        {{ $task->title }}
    </h1>

    <div class="text-gray-500 text-sm mt-2">
        By {{ $task->user->name }} • {{ $task->created_at->format('M d, Y') }}
    </div>

    <div class="mt-6 prose max-w-none">
        {!! $task->description !!}
    </div>

</div>

@endsection