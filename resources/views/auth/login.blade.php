@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-green-600 mb-4">Login</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <input name="email" type="email" placeholder="Email" value="{{old('email')}}" class="w-full border p-2 mb-4 rounded" />

        <input name="password" type="password" placeholder="Password" class="w-full border p-2 mb-4 rounded" />

        <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            Login
        </button>
    </form>
    
</div>

@endsection