<!-- <h2>Your Tasks</h2>
<a href="/tasks/create">New Task</a>

@foreach($tasks as $task)
<div>
    <h3>{{ $task->title }}</h3>
    <p>{{ $task->description }}</p>

    <a href="/tasks/{{ $task->id }}/edit">Edit</a>

    <form method="POST" action="/tasks/{{ $task->id }}">
        @csrf
        @method('DELETE')
        <button>Delete</button>
    </form>
</div>
@endforeach

<form method="POST" action="/logout">
@csrf
<button>Logout</button>
</form> -->

@extends('layouts.app')

@section('content')

    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-green-600 mb-4">Your Tasks</h2>
            
            <a href="/tasks/create"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + New Task
            </a>
        </div>

        <div>
            <x-badge type="warning">
                {{ ucfirst(auth()->user()->highestRole()) }}
            </x-badge>
        </div>
    </div>

    <div>
        @php
            $role = auth()->user()->highestRole();
        @endphp

        @if($role === 'user')
            <div class="flex justify-end gap-2 mb-4 my-4">

                <form method="POST" action="/request-author">
                    @csrf
                    <x-button>
                    Become Author
                    </x-button>
                </form>

                <form method="POST" action="/request-editor">
                    @csrf
                    <x-button variant="secondary">
                    Become Editor
                    </x-button>
                </form>
            </div>
        @endif
    </div>
    

    <div class="mt-6 grid gap-4">
        @foreach($tasks as $task)
            <div class="bg-white p-4 rounded shadow flex justify-between items-center {{ $task->deleted_at ? 'bg-red-100' : 'bg-white' }}">
                <div>
                    <h3 class="font-bold">{{ $task->title }}</h3> 
       
                    <div class="text-gray-600">{!! $task->description !!}</div>
                    
                </div>

                
                <div class="flex item-center gap-x-2">
                    @if($task->trashed())
                    <p class="text-red-600 text-sm font-medium italic px-3 py-1.5">
                        Deleted
                    </p>
                    @endif
                    <!-- EDIT (only if not deleted) -->
        
                    @if(!$task->trashed() && $task->user_id === auth()->id())
                        <a href="/tasks/{{ $task->id }}/edit"
                        class="text-green-600 hover:bg-green-600 hover:text-white border border-green-600 px-3 py-1.5 rounded-md">
                        Edit
                        </a>
                    @endif
                    
                    @if($task->status === 'draft' && $task->user_id === auth()->id())
                        <form method="POST" action="/tasks/{{ $task->id }}/request-publish">
                            @csrf
                            <x-button variant="secondary">
                                Request Publish
                            </x-button>
                        </form>
                    @endif
                    @if(!$task->trashed())
                        <form method="POST"
                            action="/tasks/{{ $task->id }}"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <x-button variant="dangeralt">Delete</x-button>
                            <!-- <button class="text-red-600 hover:bg-red-600 hover:text-white border border-red-600 px-3 py-1.5 rounded-md cursor-pointer">
                                Delete
                            </button> -->
                        </form>
                    @endif

                    <!-- RESTORE (ONLY supervisor + deleted tasks) -->
                   
                    @if(auth()->user()->hasRole('supervisor') && $task->trashed())
                        <form method="POST" action="/tasks/{{ $task->id }}/restore">
                            @csrf
                            <x-button variant="regularalt">Restore</x-button>
                            <!-- <button class="text-blue-600 hover:bg-blue-600 hover:text-white border border-blue-600 px-3 py-1.5 rounded-md cursor-pointer">
                                Restore
                            </button> -->
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

@endsection