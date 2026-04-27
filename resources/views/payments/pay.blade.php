

@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto mt-10">

    <div class="bg-white shadow rounded-lg p-6">

        <h2 class="text-2xl font-bold mb-4">
            Pay to View Blog
        </h2>

        <p class="text-gray-600 mb-4">
            You must pay to read this blog post.
        </p>

        <div class="mb-4">
            <h3 class="font-semibold text-lg">
                {{ $blog->title }}
            </h3>

            <p class="text-sm text-gray-500">
                By {{ $blog->user->name }}
            </p>
        </div>

        <div class="border-t pt-4 mt-4">

            <p class="mb-3">
                Amount: <strong>₦500</strong>
            </p>

            <form id="paymentForm">
                @csrf

                <button
                    type="button"
                    onclick="payWithPaystack()"
                    class="bg-green-600 text-white px-4 py-2 rounded w-full"
                >
                    Pay with Paystack
                </button>
            </form>

            <script src="https://js.paystack.co/v1/inline.js"></script>

            <script>
            function payWithPaystack() {

                let handler = PaystackPop.setup({
                    key: "{{ env('PAYSTACK_PUBLIC_KEY') }}",
                    email: "{{ auth()->user()->email }}",
                    amount: 50000, // ₦500 in kobo

                    callback: function(response){
                        // redirect to success route
                        window.location.href = "/payment-success/{{ $blog->id }}?reference=" + response.reference;
                    },

                    onClose: function(){
                        alert('Payment cancelled');
                    }
                });

                handler.openIframe();
            }
            </script>

        </div>

        <div class="mt-3">
            <a href="/blogs"
               class="text-gray-500 text-sm">
               ← Back to blogs
            </a>
        </div>

    </div>

</div>

@endsection



