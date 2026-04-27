@extends('layouts.app')

@section('content')

    <h2 class="text-2xl font-bold mb-4">
    Role Requests
    </h2>

    <table class="w-full border">

        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">User</th>
                <th>Requested Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach($requests as $request)

                <tr class="border-t">

                    <td class="p-2">{{ $request->user->name }}</td>

                    <td>
                        <x-badge type="warning">
                        {{ ucfirst($request->requested_role) }}
                        </x-badge>
                    </td>

                    <td>
                        @if($request->status == 'pending')
                            <x-badge>Pending</x-badge>
                        @endif

                        @if($request->status == 'approved')
                            <x-badge type="success">Approved</x-badge>
                        @endif

                        @if($request->status == 'rejected')
                            <x-badge type="danger">Rejected</x-badge>
                        @endif
                    </td>

                    <td class="flex gap-2 p-2">

                        @if($request->status == 'pending')

                            <form method="POST"
                            action="/role-requests/{{ $request->id }}/approve">
                            @csrf
                                <x-button>
                                Approve
                                </x-button>
                            </form>

                        <form method="POST"
                        action="/role-requests/{{ $request->id }}/reject">
                        @csrf
                            <x-button variant="danger">
                            Reject
                            </x-button>
                        </form>

                        @endif

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

@endsection