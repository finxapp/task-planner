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

    @if(auth()->user()->role === 'supervisor')
    <p class=" font-bold text-yellow-600 border border-yellow-600 px-3 py-1.5 rounded-md">Supervisor</p>
    @endif
</div>


<div class="mt-6 grid gap-4">
@foreach($tasks as $task)
    <div class="bg-white p-4 rounded shadow flex justify-between items-center {{ $task->deleted_at ? 'bg-red-100' : 'bg-white' }}">
        <div>
            <h3 class="font-bold">{{ $task->title }}</h3> 
            <!-- @if(auth()->user()->role === 'supervisor') -->
            <!-- <span class="font-semibold text-green-600">{{$task->user_id}}</span> -->
            <!-- @endif -->
            <!-- <p class="text-gray-600">{{ $task->description }}</p> -->
            <div class="text-gray-600">{!! $task->description !!}</div>
            
        </div>

        
        <div class="flex item-center gap-x-2">
            @if($task->deleted_at)
               <p class="text-red-600 text-sm font-medium italic px-3 py-1.5">
                   Deleted
               </p>
           @endif
             <!-- EDIT (only if not deleted) -->
            @if(!$task->deleted_at && auth()->user()->role === 'user')
                <a href="/tasks/{{ $task->id }}/edit"
                class="text-green-600 hover:bg-green-600 hover:text-white border border-green-600 px-3 py-1.5 rounded-md">
                Edit
                </a>
            @endif
            
            @if(!$task->deleted_at)
                <form method="POST"
                    action="/tasks/{{ $task->id }}"
                    class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:bg-red-600 hover:text-white border border-red-600 px-3 py-1.5 rounded-md">
                        Delete
                    </button>
                </form>
            @endif

            <!-- RESTORE (ONLY supervisor + deleted tasks) -->
             @if(auth()->user()->role === 'supervisor' && $task->deleted_at)
                <form method="POST" action="/tasks/{{ $task->id }}/restore">
                    @csrf
                    <button class="text-green-600 hover:bg-green-600 hover:text-white border border-green-600 px-3 py-1.5 rounded-md">
                        Restore
                    </button>
                </form>
            @endif
        </div>


    </div>
@endforeach
</div>

@endsection