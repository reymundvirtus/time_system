<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    //? display the register page when your not loggedin
    public function __construct() {

        $this->middleware(['guest']);
    }
    
    public function index() {
        $registers = DB::select('SELECT * FROM registers');
        $roles = DB::select('SELECT * FROM roles LIMIT 2');

        return view('auth.signup', ['registers' => $registers, 'roles' => $roles]);
    }

    public function insert(Request $request) {

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'id_code' => $request->id_code,
            'password' => Hash::make($request->id_code),
            'role_id' => $request->role_id
        ]);

        auth()->attempt($request->only('password'));

        return redirect()->route('admin'); //?
    }
}
