<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Costo_Fijo;
use Illuminate\Http\Request;
use App\Models\Estudio_Finaciero;
use App\Rules\ValidacionCostosFijos;

class Costo_Fijo_Controller extends Controller
{
    /**
     * Metodo que me muestra todos los costosFijos.
     */
    public function index(): View
    {
        // Obtengo los estudios financieros
        $estudiosFinancieros = Estudio_Finaciero::all();
        // Se lo envio en la ruta.
        return view("menu.fijos", ["estudiosFinancieros" => $estudiosFinancieros]);
    }

    /**
     * Metodo que me muestra el formulario
     */
    public function create(): View
    {
        // Le envio nada mas el nombre y el id
        $datosFinancieros = Estudio_Finaciero::select('id', 'name')->get();
        return view("costosfijos.create", ["datosFinancieros" => $datosFinancieros]);
    }

    /**
     * Metodo para agregar un nuevo costo fijo
     */
    public function store(Request $request)
    {
        // Validacion para agregar un costo fijo
        $this->validate($request, [
            // Reglas para validacion
            'id_financiero' => 'required|exists:estudios_financieros,id|integer',
            "name" => "required",
            // Se creo un propia validacion.
            "month" => ["required", "integer"],
            "amount" => "required|decimal:0,2"
        ]);
        // Hace la validacion del mes
        $this->validate($request, [
            "month" => [ new ValidacionCostosFijos($request->id_financiero)]
        ]);
        // Almaceno el costo
        $costo_fijo =  new Costo_Fijo;
        $costo_fijo->id_financiero = $request->id_financiero;
        $costo_fijo->name = $request->name;
        $costo_fijo->month = $request->month;
        $costo_fijo->amount = $request->amount;
        $costo_fijo->save();
        // Sumo la cantidad nueva en el campo correspondiente
        $estudio = $costo_fijo->estudio_finaciero;
        $estudio->Total_Costos_Fijos += $costo_fijo->amount;
        $estudio->save();
        // Redirecciono a la tabla y le envio que se agrego correctamente.
        return redirect()->route("costos_fijos.index")->with("success", "Se agrego un nuevo costo fijo");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Metodo para enviar al formulario editar
     */
    public function edit($id)
    {
        // Buscamos el costo id por su id
        $costo_fijo = Costo_Fijo::find($id);
        // Envio las dos columnas de id y nombre
        $datosFinancieros = Estudio_Finaciero::select('id', 'name')->get();
        // Se lo envio a la vista.
        return view("costosfijos.update", [
            "costo_fijo" => $costo_fijo,
            "datosFinancieros" => $datosFinancieros,
        ]);
    }

    /**
     *  Metodo para actualizar.
     */
    public function update(Request $request, $id)
    {
        // Busco el id
        $costo_fijo = Costo_Fijo::find($id);
        // Pregunto si es el mismo mes si es asi.
        if ($costo_fijo->month == $request->month) {
            // Hara la siguientes validaciones
            $this->validate($request, [
                // Reglas para validacion
                'id_financiero' => 'required|exists:estudios_financieros,id',
                "name" => "required",
                // Se creo un propia validacion.
                "month" => "required|integer",
                "amount" => "required|decimal:0,2"
            ]);
        // De lo contrario si no es el mismo mes hara otra validaciones.
        } else {
            // Validacion para agregar un costo fijo
            $this->validate($request, [
                // Reglas para validacion
                'id_financiero' => 'required|exists:estudios_financieros,id',
                "name" => "required",
                // Se creo un propia validacion.
                "month" => ["required", "integer", new ValidacionCostosFijos($request->id_financiero)],
                "amount" => "required|decimal:0,2"
            ]);
        }
        // Sacar la diferencia entre el nuevo valor y el que ya tengo.
        $total = $costo_fijo->amount - $request->amount;
        // Modifico los valores.
        $costo_fijo->id_financiero = $request->id_financiero;
        $costo_fijo->name = $request->name;
        $costo_fijo->month = $request->month;
        $costo_fijo->amount = $request->amount;
        $costo_fijo->save();
        // Hacemos la modificacion en estudio financiero.
        $estudio = $costo_fijo->estudio_finaciero;
        $estudio->Total_Costos_Fijos -= $total;
        $estudio->save();
        // Redirecciono a la tabla donde estan todos.
        return redirect()->route("costos_fijos.index")->with("success", "Se modifico un costo fijo");
    }

    /**
     * Metodo para eliminar
     */
    public function destroy($id)
    {
        // Busco el id en el modelo Costo_Fijo
        $costo_fijo = Costo_Fijo::find($id);
        // Obtengo el estudio financiero que corresponda
        $estudio = $costo_fijo->estudio_finaciero;
        // Hago el descuento del costo fijo eliminado
        $estudio->Total_Costos_Fijos -= $costo_fijo->amount;
        // Hago la actualizacion
        $estudio->save();
        // Elimino el costo fijo
        $costo_fijo->delete();
        // Lo redirecciono a la tabla y le envio un mensaje de que se borro correctamente
        return redirect()->route('costos_fijos.index')->with('success', 'Se elimino exitosamente un costo fijo');
    }
}
