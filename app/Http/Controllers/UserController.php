<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index');
    }

    private function authorizeAdmin()
    {
        if (Auth::user()->role_id != 1) {
            abort(403, 'Unauthorized action.');
        }
    }
}

