@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto mt-10 text-center">

    <div class="bg-white shadow rounded-lg p-6">

        <h2 class="text-2xl font-bold text-green-600 mb-3">
            Payment Successful
        </h2>

        <p class="mb-4">
            You can now view the blog post.
        </p>

        <a href="/blogs/{{ $blog->id }}"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Continue to Blog
        </a>

    </div>

</div>

@endsection