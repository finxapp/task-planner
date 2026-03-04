@extends('layouts.app')

@section('content')

<div class="text-center mt-20">
    <h1 class="text-4xl font-bold text-green-600 mb-4">
        Welcome to Task Planner
    </h1>

    <p class="text-gray-600 mb-6">
        Organize your daily tasks and boost your productivity.
    </p>

    <div>
        <a href="/login" class="bg-green-600 text-white px-6 py-2 rounded mr-4 hover:bg-green-700">
            Login
        </a>

        <a href="/register" class="border border-green-600 text-green-600 px-6 py-2 rounded hover:bg-green-600 hover:text-white">
            Register
        </a>
    </div>
</div>

@endsection