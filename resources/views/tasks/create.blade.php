<!-- <h2>Create Task</h2>

<form method="POST" action="/tasks">
    @csrf

    <input type="text" name="title" placeholder="Task Title">
    <br><br>

    <textarea name="description" placeholder="Task Description"></textarea>
    <br><br>

    <button type="submit">Create Task</button>
</form>

<a href="/tasks">Back</a> -->

@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-md">

    <h2 class="text-2xl font-bold text-primary mb-6">
        Create New Task
    </h2>

    <form method="POST" action="/tasks">
        @csrf

        <!-- Title -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2 font-medium">
                Title
            </label>

            <input 
                type="text"
                name="title"
                value="{{ old('title') }}"
                placeholder="Enter task title"
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                required
            >

            @error('title')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label class="block text-gray-700 mb-2 font-medium">
                Description
            </label>

            <textarea 
                name="description"
                rows="4"
                placeholder="Enter task description (optional)"
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
            >{{ old('description') }}</textarea>

            @error('description')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center">

            <a href="/tasks" 
               class="text-gray-600 hover:text-green-600">
                Cancel
            </a>

            <button 
                type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                Create Task
            </button>

        </div>

    </form>

</div>

@endsection