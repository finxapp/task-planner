<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class BlogController extends Controller
{
    public function create() {
        abort_unless(auth()->user()->hasRole('author'),403);

        return view('blogs.create');
    }

    public function index() {
        $blogs = Blog::where('status','approved')
                    ->latest()
                    ->get();

        return view('blogs.index',compact('blogs'));
    }

    public function store(Request $request) {
        abort_unless(auth()->user()->hasRole('author'),403);

        $validated = $request->validate([
            'title'=>'required|min:3',
            'content'=>'required|min:10'
        ]);

        Blog::create([
            'title'=>$validated['title'],
            'content'=>$validated['content'],
            'user_id'=>Auth::id(),
            'status'=>'pending'
        ]);

        return redirect('/blogs')->with('success','Blog submitted for review');
    }

    public function edit(Blog $blog) {
        abort_if($blog->user_id !== auth()->id(),403);

        return view('blogs.edit',compact('blog'));
    }

    public function update(Request $request, Blog $blog) {
        abort_if($blog->user_id !== auth()->id(),403);

        $blog->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'status'=>'pending'
        ]);

        return redirect('/my-blogs')
            ->with('success','Blog updated & resubmitted');
    }

    public function reviewList() {
        abort_unless(
            auth()->user()->hasAnyRole([
                'editor',
                'admin',
                'superadmin',
                'supervisor'
            ]),
            403
        );

        $blogs = Blog::whereIn('status',[
            'pending',
            'review'
        ])->latest()->get();

        return view('blogs.review',compact('blogs'));
    }

    public function markReview(Blog $blog) {
        abort_unless(auth()->user()->hasRole('editor'),403);

        $blog->update([
            'status'=>'review'
        ]);

        return back()->with('success','Marked for review');
    }

    public function approve(Blog $blog) {
        abort_unless(auth()->user()->hasRole('editor'),403);

        $blog->update([
            'status'=>'approved'
        ]);

        return back()->with('success','Blog approved');
    }

    public function reject(Blog $blog) {
        abort_unless(auth()->user()->hasRole('editor'),403);

        $blog->update([
            'status'=>'rejected'
        ]);

        return back()->with('success','Blog rejected');
    }


    public function show(Blog $blog)
    {
        // Guests must login first
        if (!auth()->check()) {
            return redirect()->guest(route('login'))
                ->with('error','Login to continue');
        }

        $user = auth()->user();

        // Staff roles can always view (even unapproved)
        if ($user->hasAnyRole(['editor','admin','superadmin','supervisor'])) {
            return view('blogs.show', compact('blog'));
        }

        // Blog author can view their own blog (even if not approved)
        if ($user->id === $blog->user_id) {
            return view('blogs.show', compact('blog'));
        }

        // Other users → only approved blogs
        if ($blog->status !== 'approved') {
            abort(404);
        }

        // Check if user has paid
        $paid = Payment::where('user_id', $user->id)
            ->where('blog_id', $blog->id)
            ->exists();

        if (!$paid) {
            return redirect("/blogs/{$blog->id}/pay");
        }

        return view('blogs.show', compact('blog'));

    }

    public function myBlogs(){
        $blogs = Blog::where('user_id', auth()->id())
                    ->latest()
                    ->get();

        return view('blogs.my', compact('blogs'));
    }
}
