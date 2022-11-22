<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $registers = DB::select('SELECT * FROM registers');
        $roles = DB::select('SELECT * FROM roles');
        $users = DB::select('SELECT * FROM users');

        return view('employee', ['registers' => $registers, 'roles' => $roles, 'users' => $users]);
    }

    public function select_users_emp()
    {

        date_default_timezone_set('Asia/Manila');  // for other timezones, refer:- https://www.php.net/manual/en/timezones.asia.php
        $d = date("Y-m-d");
        $date_time = $d;

        $users = DB::table('users')
            ->join('user_times', 'user_times.user_id_code', '=', 'users.id_code')
            ->select('users.*', 'user_times.*')->where('date_recorded', '=', $date_time)
            ->get();

        return response()->json($users);
    }

    //? search users
    public function search_user(Request $request)
    {

        $search = DB::table('users')
            ->join('user_times', 'user_times.user_id_code', '=', 'users.id_code')
            ->where('name', 'LIKE', $request->search . '%')->get();

        return response()->json($search);
    }
}
