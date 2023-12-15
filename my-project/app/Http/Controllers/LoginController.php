<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        // Le envio el archivo view y donde se encuenta
        return view('auth.login');
    }

    public function store(Request $request){
        /**
         * Valida que el request tenga valor y el email sea
         * un email.
         * El password lo haya ingresado.
         */
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Hacemos la autenticacion
        if(!auth()->attempt($request->only('email','password'))){
            /**
             * Lo que hacemos es retornar un mensaje de que
             * es incorrecto sus datos.
             */
            return back()->with('mensaje','Credenciales Incorrectas');
        }
        // Si todo esta bien lo redirecciona al menu (dashboard)
        return redirect()->route('menu');
    }
}
