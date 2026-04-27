<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    
    public function index() {
        if(auth()->user()->hasAnyRole(['supervisor','admin','superadmin'])){
            $tasks = Task::withTrashed()->latest()->get();
        } else {
            $tasks = Auth::user()->tasks;
        }

        return view('tasks.index', compact('tasks'));
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(Request $request) {
        // $request->validate(['title'=>'required']);
        $validated = $request->validate([
            'title'=>'required|min:3|max:255',
            'description'=>'nullable|min:5'
            // 'status' => Task::STATUS_DRAFT
        ]);

        Task::create([
            'title'=>strip_tags($validated['title']),
            'description'=>$validated['description'], // no strip_tags
            'user_id'=>Auth::id(),
            'status' => Task::STATUS_DRAFT
        ]);

        // return redirect('/tasks');        
        return redirect('/tasks')->with('success','Task created successfully');
    }


    public function edit(Task $task) {
        abort_if($task->user_id !== Auth::id(), 403);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task) {
        // $task->update($request->all());

        abort_if($task->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'title'=>'required|min:3|max:255',
            'description'=>'nullable|min:5'
        ]);

        $task->update([
            'title'=>strip_tags($validated['title']),
            'description'=>$validated['description'], // no strip_tags
        ]);
        
        // return redirect('/tasks');
        return redirect('/tasks')->with('success','Task updated successfully');
    }

    public function restore($id) {
        // if(auth()->user()->role !== 'supervisor'){
        if(!auth()->user()->hasRole('supervisor')){
            abort(403);
        }

        $task = Task::withTrashed()->findOrFail($id);
        $task->restore();

        return back()->with('success','Task restored successfully');
    }

    public function destroy(Task $task) {
        if(!auth()->user()->hasRole('supervisor') && $task->user_id !== Auth::id()){
            abort(403);
        }

        $task->delete();
        return back();
    }


    public function requestPublish(Task $task) {
        abort_if($task->user_id !== auth()->id(), 403);

        $task->update([
            'status' => Task::STATUS_PENDING
        ]);

        return back()->with('success','Publish request sent');
    }

    public function publishRequests() {
        abort_unless(auth()->user()->hasAnyRole(['supervisor','admin','superadmin']), 403);

        $tasks = Task::whereIn('status',[
            Task::STATUS_PENDING,
            Task::STATUS_REVIEW
        ])->latest()->get();

        return view('tasks.publish-requests',compact('tasks'));
    }

    public function markReview(Task $task) {
        abort_unless(auth()->user()->hasAnyRole(['supervisor','admin','superadmin']), 403);

        $task->update([
            'status' => Task::STATUS_REVIEW
        ]);

        return back()->with('success','Marked as review');
    }

    public function approve(Task $task) {
        abort_unless(auth()->user()->hasAnyRole(['supervisor','admin','superadmin']), 403);

        $task->update([
            'status' => Task::STATUS_APPROVED
        ]);

        return back()->with('success','Post approved');
    }

    public function published(){
    //     $tasks = Task::where('status',Task::STATUS_APPROVED)->latest()->get();

    //     return view('tasks.published',compact('tasks'));
    // }
        $tasks = Task::with('user')
            ->where('status', Task::STATUS_APPROVED)
            ->latest()
            ->get();

        return view('tasks.published', compact('tasks'));
    }

    public function showPublished(Task $task) {
        if ($task->status !== Task::STATUS_APPROVED) {
            abort(404);
        }

        return view('tasks.show-published', compact('task'));
    }
    
}