

    <!-- <div class="max-w-md mx-auto">

        <x-card>

            <h2 class="text-xl font-bold mb-4">
            Test Payment Gateway
            </h2>

            <p class="mb-4">
            Simulated payment for:
            <strong>{{ $blog->title }}</strong>
            </p>

            <form method="POST" action="/payment-success/{{ $blog->id }}">
                @csrf

                <x-button>
                Simulate Successful Payment
                </x-button>
            </form>

        </x-card>

    </div> -->

    @extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto mt-10 text-center">

    <div class="bg-white shadow rounded-lg p-6">

        <h2 class="text-xl font-bold mb-4">
            Fake Payment Gateway
        </h2>

        <p class="mb-4">
            Simulating payment for:
        </p>

        <h3 class="font-semibold mb-4">
            {{ $blog->title }}
        </h3>

        <form method="POST" action="/payment-success/{{ $blog->id }}">
            @csrf

            <button class="bg-green-600 text-white px-4 py-2 rounded w-full">
                Simulate Successful Payment
            </button>
        </form>

        <a href="/blogs" class="text-gray-500 text-sm block mt-3">
            Cancel
        </a>

    </div>

</div>

@endsection