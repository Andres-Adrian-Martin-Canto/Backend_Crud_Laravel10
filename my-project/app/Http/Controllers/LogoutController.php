<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function store(){
        // Cerrar sesion
        auth()->logout();
        // Redirecciono al login
        return redirect()->route('login');
    }
}
