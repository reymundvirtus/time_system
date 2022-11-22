<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;

class GetIDCode extends Controller
{
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
