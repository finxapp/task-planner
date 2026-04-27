<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleRequestController extends Controller
{
    public function requestAuthor() {
        RoleRequest::create([
            'user_id' => Auth::id(),
            'requested_role' => 'author',
            'status' => 'pending'
        ]);

        return back()->with('success','Author request submitted');
    }

    public function requestEditor() {
        RoleRequest::create([
            'user_id' => Auth::id(),
            'requested_role' => 'editor',
            'status' => 'pending'
        ]);

        return back()->with('success','Editor request submitted');
    }

    public function index() {
        if (!auth()->user()->hasAnyRole(['supervisor','admin','superadmin'])) {
            abort(403);
        }

        $requests = RoleRequest::with('user')->latest()->get();

        return view('roles.requests', compact('requests'));
    }

    public function approve(RoleRequest $roleRequest) {
        if (!auth()->user()->hasAnyRole(['supervisor','admin','superadmin'])) {
            abort(403);
        }

        $user = $roleRequest->user;

        $user->assignRole($roleRequest->requested_role);

        $roleRequest->update([
            'status' => 'approved'
        ]);

        return back()->with('success','Role approved successfully');
    }

    public function reject(RoleRequest $roleRequest) {
        if (!auth()->user()->hasAnyRole(['supervisor','admin','superadmin'])) {
            abort(403);
        }

        $roleRequest->update([
            'status' => 'rejected'
        ]);

        return back()->with('success','Role request rejected');
    }
}
