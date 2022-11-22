<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //? display the register page when your not loggedin
    public function __construct() {

        $this->middleware(['auth']);
    }

    public function index() {

        return view('admin_home');
    }
}
