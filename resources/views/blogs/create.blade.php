@extends('layouts.app')

@section('content')

    
<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-md">
    
    
    <h2 class="text-2xl font-bold text-primary mb-6">
        Create New Blog
    </h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="/blogs">
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

        <!-- Content -->
        <div class="mb-6">
            <label class="block text-gray-700 mb-2 font-medium">
                Content
            </label>
             <textarea 
                name="content"
                id="description"
                rows="4"
                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600"
            >{{ old('content') }}</textarea>
       
            
            @error('content')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center">

            <a href="/blogs" 
               class="text-gray-600 hover:text-green-600 transition">
                Cancel
            </a>

            <x-button variant="primary">Create Blog</x-button>

        </div>
        
    </form>
    
</div>
@endsection

