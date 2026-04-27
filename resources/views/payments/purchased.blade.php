@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">
            My Purchased Blogs
        </h2>

        <a href="/blogs"
           class="text-green-600">
           Browse Blogs
        </a>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">

        @forelse($payments as $payment)

            <x-card>

                <h3 class="font-bold text-lg">
                    {{ $payment->blog->title ?? 'Blog not available' }}
                </h3>

                <p class="text-sm text-gray-500">
                    Purchased {{ $payment->created_at->diffForHumans() }}
                </p>

                <p class="mt-2 text-gray-600">
                    {{ \Illuminate\Support\Str::limit(strip_tags($payment->blog->content ?? ''), 80) }}
                </p>

                <a href="/blogs/{{ $payment->blog->id }}"
                   class="inline-block mt-3 text-green-600 font-semibold">
                    Read Blog →
                </a>

            </x-card>

        @empty

            <div class="col-span-full text-center text-gray-500">

                <p class="mb-4">You haven't purchased any blogs yet.</p>

                <a href="/blogs"
                   class="bg-green-600 text-white px-4 py-2 rounded">
                   Explore Blogs
                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection