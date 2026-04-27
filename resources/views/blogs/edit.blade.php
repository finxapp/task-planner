@extends('layouts.app')

@section('content')

    <div class="max-w-2xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">
    Edit Blog
    </h2>

        <form method="POST" action="/blogs/{{ $blog->id }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Title</label>
                <input 
                    type="text"
                    name="title"
                    value="{{ old('title', $blog->title) }}"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600"
                    required
                >
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 mb-2 font-medium">
                    Content
                </label>

                <textarea 
                    name="content"
                    id="description"
                    rows="4"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600"
                >{{ old('content', $blog->content) }}</textarea>
            </div>

            <div class="flex justify-between items-center">

                <a href="/blogs/{{ $blog->id }}" 
                class="text-gray-600 hover:text-green-600">
                    Cancel
                </a>

                <x-button variant="primary">Update</x-button>
            </div>

        </form>

    </div>

@endsection