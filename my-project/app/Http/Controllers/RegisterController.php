<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index(){
        return view('auth.crear-cuenta');
    }

    public function store(Request $request){

        // Validar los parametros enviados.
        $this->validate($request,[
            'name' => 'required|max:30',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        // Hacemos insert a la base de datos con nuestros valores enviados.
        User::create([
            'name' => $request->get('name'),
            'email' => $request->email,
            'password' => Hash::make($request->get('password'))
        ]);
        // Autenticamos
        auth()->attempt($request->only('email','password'));
        // y lo enviamos al menu.
        return redirect()->route('menu');


    }

}
