<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index() {
        $tasks = Auth::user()->tasks;
        return view('tasks.index', compact('tasks'));
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(Request $request) {
        $request->validate(['title'=>'required']);

        Task::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>Auth::id()
        ]);

        return redirect('/tasks');
    }

    // public function edit(Task $task) {
    //     return view('tasks.edit', compact('task'));
    // }

    public function edit(Task $task) {
        abort_if($task->user_id !== Auth::id(), 403);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task) {
        $task->update($request->all());
        return redirect('/tasks');
    }

    public function destroy(Task $task) {
        $task->delete();
        return back();
    }
}