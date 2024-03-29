<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //? this will logout the user
    public function logout() {

        auth()->logout();

        return redirect()->route('login');
    }
}
