<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        if(!auth()->user()->hasAnyRole(['supervisor','admin','superadmin'])){
            abort(403);
        }

        $users = User::withTrashed()->latest()->get();

        return view('users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if(!auth()->user()->canDeleteUser($user)){
            abort(403);
        }

        $user->delete();

        return back()->with('success','User deleted');
    }

    public function restore($id) {
        if(!auth()->user()->hasAnyRole(['supervisor','admin','superadmin'])){
            abort(403);
        }

        
        $user = User::withTrashed()->findOrFail($id);
        
        if(!auth()->user()->canDeleteUser($user)){
            abort(403);
        }
        
        $user->restore();

        return back()->with('success','User restored successfully');
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string'
        ]);

        $authUser = auth()->user();

        // cannot assign to yourself (optional safety)
        if ($authUser->id === $user->id) {
            abort(403);
        }

        $role = $request->role;

        // hierarchy check
        if (!$authUser->canAssignRole($role)) {
            abort(403);
        }

        // remove old roles and assign new one
        $user->syncRoles([$role]);

        return back()->with('success','Role updated successfully');
    }
}
