<!-- <form method="POST" action="/register">
@csrf
<input name="name" placeholder="Name">
<input name="email" placeholder="Email">
<input name="password" type="password" placeholder="Password">
<button>Register</button>
</form> -->

@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-green-600 mb-4">Register</h2>

    <form method="POST" action="/register">
        @csrf

        <input name="name" type="text" placeholder="Name" class="w-full border p-2 mb-4 rounded">
        <input name="email" type="email" placeholder="Email" class="w-full border p-2 mb-4 rounded">

        <input name="password" type="password" placeholder="Password" class="w-full border p-2 mb-4 rounded">

        <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            Register
        </button>
    </form>
</div>

@endsection