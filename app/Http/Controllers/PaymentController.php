<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function show(Blog $blog) {
        return view('payments.pay', compact('blog'));
    }

    public function initiate(Blog $blog)
    {
        // redirect to fake gateway
        return redirect()->route('payment.gateway', $blog->id);
    }

    public function success(Request $request, Blog $blog)
    {
        $reference = $request->query('reference') ?? 'TEST_' . uniqid();

        Payment::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'blog_id' => $blog->id
            ],
            [
                'payment_reference' => $reference
            ]
        );

        return redirect("/blogs/{$blog->id}")
            ->with('success','Payment successful');
    }

    public function gateway(Blog $blog)
    {
        return view('payments.gateway', compact('blog'));
    }

    public function myPurchases()
    {
        $payments = Payment::with('blog')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('payments.purchased', compact('payments'));
    }
}
