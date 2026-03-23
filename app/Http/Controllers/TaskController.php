<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index() {
        // $tasks = Auth::user()->tasks;

        if(auth()->user()->role === 'supervisor'){
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
        ]);

        

        // Task::create([
        //     'title'=>$request->title,
        //     'description'=>$request->description,
        //     'user_id'=>Auth::id()
        // ]);
        Task::create([
            'title'=>strip_tags($validated['title']),
            'description'=>$validated['description'], // no strip_tags
            'user_id'=>Auth::id()
        ]);

        return redirect('/tasks');        
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
        
        return redirect('/tasks');
    }

    public function restore($id) {
        if(auth()->user()->role !== 'supervisor'){
            abort(403);
        }

        $task = Task::withTrashed()->findOrFail($id);
        $task->restore();

        return back()->with('success','Task restored successfully');
    }

    public function destroy(Task $task) {
        if(auth()->user()->role !== 'supervisor' && $task->user_id !== Auth::id()){
            abort(403);
        }

        $task->delete();
        return back();
    }
}