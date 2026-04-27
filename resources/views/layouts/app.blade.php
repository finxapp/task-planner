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
        
        @if(session('success'))
            <x-alert type="success">
                {{ session('success') }}
            </x-alert>
        @endif

        @if(session('error'))
            <x-alert type="error">
                {{ session('error') }}
            </x-alert>
        @endif
        
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="font-bold">Task Planner & Blog</a>

            <div>
                @role('supervisor|admin|superadmin')
                    <a href="/role-requests" class="hover:underline px-3 font-semibold">
                    Role Requests
                    </a>
                    <a href="/users" class="hover:underline px-3 font-semibold">
                    Users
                    </a>
                @endrole
                
                @role('editor|admin|superadmin|supervisor')
                   <a href="/blogs/review" class="hover:underline px-3">
                        Review Blogs
                    </a>
                @endrole
                
            </div>

            @auth
                <div>
                    <div  class="flex items-center gap-4">
                        <a href="/blogs" class="hover:underline px-3">
                            Blogs
                        </a>
                        <a href="/my-purchases" class="text-sm">
                            My Purchases
                        </a>
                        <!-- <a href="/tasks" class="mr-4 hover:underline">Tasks</a> -->
    
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button class="bg-white text-green-600 px-3 py-1 rounded">
                                Logout
                            </button>
                        </form>

                    </div>
                @else
                <div class="flex items-center gap-4">
                    <a href="/blogs" class="hover:underline px-3">
                        Blogs
                    </a>
                    <a href="/login" class="mr-4 hover:underline px-3">Login</a>
                    <a href="/register" class="bg-white text-green-600 px-3 py-1 rounded">
                        Register
                    </a>
                </div>
                </div>
            @endauth
        </div>
    </nav>

    <div class="container mx-auto p-6">
        @yield('content')
    </div>

</body>
</html>