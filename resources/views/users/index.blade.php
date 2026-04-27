
@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">All Users</h2>

<table class="w-full border border-gray-200 rounded-lg shadow">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="p-2">Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
        <tr class="border-t border-gray-200 hover:bg-gray-50 text-left">
            <td class="p-2">{{ $user->name }}</td>
            <td>{{ $user->email }}</td>

            <td>
                <!-- {{ $user->highestRole() }} -->
                @foreach($user->getRoleNames() as $role)
                <span class="inline-block mr-1 my-1">   
                    <x-badge type="{{ 
                        $role === 'superadmin' ? 'danger' : 
                        ($role === 'admin' ? 'warning' : 
                        ($role === 'editor' ? 'info' : 'info')) 
                    }}">
                        {{ ucfirst($role) }}
                    </x-badge>
                </span>
                @endforeach

                @if($user->trashed())
                    <x-badge type="danger">Deleted</x-badge>
                @endif

                @if(auth()->user()->canAssignRole('user') && !$user->trashed())
                    <form method="POST" action="/users/{{ $user->id }}/assign-role" class="mt-2">
                        @csrf

                        <select name="role" class="border rounded px-2 py-1 text-sm">
                            <option value="">Change Role</option>

                            @if(auth()->user()->canAssignRole('admin'))
                                <option value="admin">Admin</option>
                            @endif

                            @if(auth()->user()->canAssignRole('supervisor'))
                                <option value="supervisor">Supervisor</option>
                            @endif

                            @if(auth()->user()->canAssignRole('editor'))
                                <option value="editor">Editor</option>
                            @endif

                            @if(auth()->user()->canAssignRole('author'))
                                <option value="author">Author</option>
                            @endif

                            <option value="user">User</option>
                        </select>

                        <button class="ml-2 text-blue-600 text-sm">Assign</button>
                    </form>
                @endif
            </td>
            
            <td>
                @if($user->trashed())

                    @if(auth()->user()->canDeleteUser($user))
                    <form method="POST" action="/users/{{ $user->id }}/restore">
                        @csrf
                        <x-button variant="primary">
                            Restore
                        </x-button>
                    </form>
                    @endif

                @else

                    @if(auth()->user()->canDeleteUser($user))
                    <form method="POST" action="/users/{{ $user->id }}">
                        @csrf
                        @method('DELETE')

                        <x-button variant="dangeralt">
                            Delete
                        </x-button>
                    </form>
                    @endif

                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection