<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //? display the register page when your not loggedin
    public function __construct() {

        $this->middleware(['auth']);
    }

    public function index() {
        $registers = DB::select('SELECT * FROM registers');
        $roles = DB::select('SELECT * FROM roles');
        $users = DB::select('SELECT * FROM users');

        return view('users', ['registers' => $registers, 'roles' => $roles, 'users' => $users]);
    }

    //? select all users
    public function select_users() {

        $users = DB::table('roles')
            ->join('users', 'users.role_id', '=', 'roles.id')
            ->select('roles.*','users.*')
            ->get();

        return response()->json($users);
    }

    //? create users
    public function create_user(Request $request) {

        $create = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'id_code' => $request->id_code,
            'password' => Hash::make($request->id_code),
            'role_id' => $request->role_id
        ]);

        return response()->json($create);
    }

    //? update users
    public function update_user(Request $request) {

        $update = DB::table('users')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'id_code' => $request->id_code,
                'role_id' => $request->role_id,
            ]);

        return response()->json($update);
    }

    //? delete users
    public function delete_user(Request $request) {

        $delete = DB::table('users')
            ->where('id', $request->id)
            ->delete();

        return response()->json($delete);
    }

    //? search users
    public function search_user(Request $request) {

        $search = DB::table('users')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->where('name', 'LIKE', $request->search.'%')->get();

        return response()->json($search);
    }

    //? get the id code
    public function id_code() {

        // $id_code = DB::table('register')
        //     ->where('id', 0)
        //     ->get();

        // $id_code = DB::select('SELECT * FROM register');
        $id_code = Register::all();
        return response()->json($id_code);
    }
}
