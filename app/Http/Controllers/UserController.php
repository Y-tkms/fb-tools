<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function index() {
        $all_user = $this->user->where('id', '!=', Auth::user()->id)->get();

        if(Auth::user()->role != 'a') {
            return redirect()->route('index');
        }

        return view('users.index')->with('all_user', $all_user);
    }

    public function edit($id) {
        $user = $this->user->findOrFail($id);

        if(Auth::user()->role != 'a') {
            return redirect()->route('index');
        }

        return view('users.edit')->with('user', $user);
    }

    public function update(Request $request, $id) {
        $user = $this->user->findOrFail($id);

        $user->name = $request->name;
        $user->role = $request->auth;
        $user->save();

        return redirect()->route('user.index');
    }

    public function delete($id) {
        $user = $this->user->findOrFail($id);

        if(Auth::user()->role != 'a') {
            return redirect()->route('index');
        }

        return view('users.delete')->with('user', $user);
    }

    public function destroy($id) {
        $this->user->destroy($id);

        return redirect()->route('user.index');
    }
}
