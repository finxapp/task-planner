<!-- <h2>Edit Task</h2>

<form method="POST" action="/tasks/{{ $task->id }}">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $task->title }}">
    <br><br>

    <textarea name="description">{{ $task->description }}</textarea>
    <br><br>

    <button type="submit">Update Task</button>
</form>

<a href="/tasks">Back</a> -->

@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-md">

    <h2 class="text-2xl font-bold text-green-600 mb-6">
        Edit Task
    </h2>

    <form method="POST" action="/tasks/{{ $task->id }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">
                Title
            </label>

            <input 
                type="text"
                name="title"
                value="{{ old('title', $task->title) }}"
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600"
                required
            >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 mb-2 font-medium">
                Description
            </label>

            <textarea 
                name="description"
                id="description"
                rows="4"
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600"
            >{{ old('description', $task->description) }}</textarea>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center">

            <a href="/tasks" 
               class="text-gray-600 hover:text-green-600">
                Cancel
            </a>

            <!-- <button 
                type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                Update Task
            </button> -->
            <x-button variant="primary">Update Task</x-button>
        </div>

    </form>

</div>

@endsection