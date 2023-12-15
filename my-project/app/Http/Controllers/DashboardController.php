<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // Le envio el archivo donde se encuentra la vista.
        return view('layouts.menu');
    }
}
