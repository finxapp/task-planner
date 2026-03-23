<!DOCTYPE html>
<!-- <html lang="en"> -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Task Planner</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
     <x-head.tinymce-config/>

</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-green-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between">
            <a href="/" class="font-bold">Task Planner</a>

            <div>
                @auth
                    <a href="/tasks" class="mr-4 hover:underline">Tasks</a>

                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button class="bg-white text-green-600 px-3 py-1 rounded">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/login" class="mr-4 hover:underline">Login</a>
                    <a href="/register" class="bg-white text-green-600 px-3 py-1 rounded">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        @yield('content')
    </div>

</body>
</html>