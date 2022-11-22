<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    //? display the register page when your not loggedin
    public function __construct() {

        $this->middleware(['auth']);
    }
    
    public function index() {

        return view('profile');
    }

    public function update_description(Request $request) {

        $update = DB::table('users')
            ->where('id', Auth::id())
            ->update(['description' => $request->description]);

        return response()->json($update);
    }
}
