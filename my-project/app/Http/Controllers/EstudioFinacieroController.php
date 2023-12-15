<?php

namespace App\Http\Controllers;

use App\Models\Estudio_Finaciero;
use Illuminate\Http\Request;

class EstudioFinacieroController extends Controller
{
    /**
     *  Metodo que me envia a la tabla donde se muestran todos los estudios
     */
    public function index()
    {
        // Obtengo todos los estudios financieros
        $estudio_financiamiento =  Estudio_Finaciero::all();
        // Se lo envio a la vista y que los muestre
        return view('menu.Estudio_Financiero', compact('estudio_financiamiento'));
    }

    /**
     *  Metodo que te envia al formulario para crear un estudio financiero.
     */
    public function create()
    {
        // Lo envia a la vista del formulario para crear.
        return view('estudioFinanciero.create');
    }

    /**
     *  Metodo para agregar un estudio financiero.
     */
    public function store(Request $request)
    {
        // Validaciones
        $this->validate($request, [
            // Reglas de validaciones
            'name'=> 'required',
            'descripcion'=> 'required',
        ]);
        // Insert a la base de datos
        Estudio_Finaciero::create([
            // Los valores y las columnas a la cual se van agregar.
            'name' => $request->get('name'),
            'descripcion' => $request->descripcion,
            'Total_Costos_Fijos' => 0,
            'Total_Costos_Variables' => 0
        ]);
        // Lo redirecciono con un mensaje de que ya se agrego.
        return redirect()->route('estudio_financiero.index')->with('success','Se agrego exitosamente un estudio financiero');
    }

    /**
     *  Metodo para buscar.
     */
    public function show(Estudio_Finaciero $estudio_Finaciero)
    {
        //
    }

    /**
     *  Metodo que te envia al formulario para editar un estudioFinanciero.
     */
    public function edit($id)
    {
        // Busco el id del estudio financiero para enviarlo a la vista
        $estudio_Finaciero = Estudio_Finaciero::find($id);
        // Lo envio a la vista los datos.
        return view('estudioFinanciero.update', ['estudio_Finaciero' => $estudio_Finaciero]);
    }

    /**
     *  Metodo para actualizar un estudio financiero
     */
    public function update(Request $request, $id)
    {
        // validacion de los valores.
        $this->validate($request, [
            'name'=> 'required',
            'descripcion'=> 'required',
        ]);
        // Buscamos el id del estudio financiero.
        $estudio_Finaciero = Estudio_Finaciero::find($id);
        // Hacemos las modificaciones de los campos correspondientes.
        $estudio_Finaciero->name = $request->get('name');
        $estudio_Finaciero->descripcion = $request->descripcion;
        // Guardamos los cambios.
        $estudio_Finaciero->save();
        // Redirecciono a la vista donde esta la tabla y le envio un mensaje de que se modifico.
        return redirect()->route('estudio_financiero.index')->with('success','Se modifico exitosamente un estudio financiero');
    }

    /**
     *  Metodo para eliminar un estudio financiero.
     */
    public function destroy($id)
    {
        // Busco el estudio financiero por el id que me envie.
        $estudio_Finaciero = Estudio_Finaciero::find($id);
        // Eliminamos el estudio financiero.
        $estudio_Finaciero->delete();
        // Le envio mensaje de que se borro el estudio financiero.
        return redirect()->route('estudio_financiero.index')->with('success','Se borro exitosamente un estudio financiero');
    }
}
