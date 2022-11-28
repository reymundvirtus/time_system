<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersTimeController extends Controller
{
    //? display the register page when your not loggedin
    public function __construct() {

        $this->middleware(['auth']);
    }

    public function index()
    {

        return view('users_time');
    }

    public function select_users_emp_time()
    {

        $emp_total_time = DB::table('user_times')
            ->join('users', 'users.id_code', '=', 'user_times.user_id_code')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select(['name', 'email', 'id_code', 'date_recorded', 'time_in', 'time_out', DB::raw('user_id_code, TIME_FORMAT(SEC_TO_TIME(SUM(time_to_sec(timediff(time_out, time_in)))), "%h:%i:%s") AS total_hour')])
            ->groupBy(['name', 'email', 'id_code', 'user_id_code', 'date_recorded', 'time_in', 'time_out'])
            ->get();

        return response()->json($emp_total_time);
    }

    public function search_user_date(Request $request)
    {
        $emp_time = DB::table('user_times')
            ->join('users', 'users.id_code', '=', 'user_times.user_id_code')
            ->select(['name', 'email', 'id_code', 'date_recorded', 'time_in', 'time_out', DB::raw('user_id_code, TIME_FORMAT(SEC_TO_TIME(SUM(time_to_sec(timediff(time_out, time_in)))), "%h:%i:%s") AS total_hour')])
            ->where('date_recorded', '=', $request->date_recorded) //$request->date_recorded '2022-11-22'
            ->groupBy(['name', 'email', 'id_code', 'user_id_code', 'date_recorded', 'time_in', 'time_out'])
            ->get();

        return response()->json($emp_time);
    }
}
