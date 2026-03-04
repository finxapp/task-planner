<!-- <h2>Your Tasks</h2>
<a href="/tasks/create">New Task</a>

@foreach($tasks as $task)
<div>
    <h3>{{ $task->title }}</h3>
    <p>{{ $task->description }}</p>

    <a href="/tasks/{{ $task->id }}/edit">Edit</a>

    <form method="POST" action="/tasks/{{ $task->id }}">
        @csrf
        @method('DELETE')
        <button>Delete</button>
    </form>
</div>
@endforeach

<form method="POST" action="/logout">
@csrf
<button>Logout</button>
</form> -->

@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold text-green-600 mb-4">Your Tasks</h2>

<a href="/tasks/create"
   class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
    + New Task
</a>

<div class="mt-6 grid gap-4">
@foreach($tasks as $task)
    <div class="bg-white p-4 rounded shadow flex justify-between items-center">
        <div>
            <h3 class="font-bold">{{ $task->title }}</h3>
            <p class="text-gray-600">{{ $task->description }}</p>
        </div>

        <div>
            <a href="/tasks/{{ $task->id }}/edit"
               class="text-green-600 mr-3 hover:underline">
               Edit
            </a>

            <form method="POST"
                  action="/tasks/{{ $task->id }}"
                  class="inline">
                @csrf
                @method('DELETE')
                <button class="text-red-500 hover:underline">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endforeach
</div>

@endsection