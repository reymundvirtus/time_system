<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //? display the register page when your not loggedin
    public function __construct() {

        $this->middleware(['guest']);
    }

    public function index() {
        $registers = DB::select('SELECT * FROM registers');

        return view('auth.login', ['registers' => $registers]);
    }

    public function attempt(Request $request) {

        //? validation
        // $this->validate($request, [
        //     'password' => 'required',
        // ]);

        //? sign the user in
        if (!auth()->attempt($request->only('email', 'password', 'role_id'))) {
            return back()->with('status', 'Invalid login details');
        }

        //? redirect after sign in based on roles
        if (Auth::user()->role_id == 1) {
            return redirect()->route('admin');
        } elseif (Auth::user()->role_id == 2) {
            return redirect()->route('manager');
        }
    }
}
