<?php

namespace App\Http\Controllers;

use App\Models\Costo_Variable;
use App\Models\Estudio_Finaciero;
use App\Rules\ValidacionCostosVariables;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Costos_Variables_Controller extends Controller
{
    /**
     * Muestra la tabla de costos variables
     */
    public function index():View
    {
        // Obtengo todos los Costos Variables
        $estudiosFinancieros = Estudio_Finaciero::all();
        // Lo envio a la vista con los datos importantes
        return view("menu.variables", ["estudiosFinancieros"=> $estudiosFinancieros]);
    }

    /**
     * Envia al formulario para crear.
     */
    public function create()
    {
        // Obtengo todos los estudios financieros
        $estudiosFinancieros = Estudio_Finaciero::all();
        // Se lo envio a la vista. La vista es: (costosvariables.crearVariables)
        return view("costosvariables.crearVariables", ["estudiosFinancieros"=> $estudiosFinancieros]);
    }

    /**
     * Metodo que te envia al formulario para agregar.
     */
    public function store(Request $request)
    {
        // Recibo el request o sea los valores que me envia el usuario
        // y valido la informacion.
        $this->validate($request, [
            // Reglas de validacion.
            'id_financiero' => ['required','exists:estudios_financieros,id','integer'],
            "name" => "required",
            // Se creo un propia validacion.
            "month" => ["required", "integer"],
            "amount" => "required|decimal:0,2"
        ]);
        // Hace la validacion del mes
        $this->validate($request, [
            "month" => [new ValidacionCostosVariables($request->id_financiero)]
        ]);
        // Almacenamos el costo variable
        $costo_variable = new Costo_Variable();
        $costo_variable->id_financiero = $request->id_financiero;
        $costo_variable->name = $request->name;
        $costo_variable->month = $request->month;
        $costo_variable->amount = $request->amount;
        $costo_variable->save();
        // Sumo la cantidad nueva en el campo correspondiente
        $estudio = $costo_variable->estudio_finaciero;
        $estudio->Total_Costos_Variables += $costo_variable->amount;
        $estudio->save();
        // Redireccionamos a la vista con su mensaje correspondiente
        return redirect()->route("costos_variables.index")->with("success", "Se agrego un nuevo costo variable");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //

    }

    /**
     *  Lo envio al formulario editar.
     */
    public function edit($id)
    {
        // busco el id que me envie
        $costo_variable = Costo_Variable::find($id);
        // Obtengo todos los estudios financieros pero solo los campos id y name
        $datosFinancieros = Estudio_Finaciero::select('id', 'name')->get();
        // Le envio a la vista con lo siguientes valores
        return view("costosvariables.modificarVariables", [
            "costo_variable" => $costo_variable,
            "datosFinancieros" => $datosFinancieros
        ]);
    }

    /**
     *  Metodo para actualizar un costos variables
     */
    public function update(Request $request, $id)
    {
        // busco el id que me envie
        $costo_variable = Costo_Variable::find($id);
        // Si es el mismo mes no le valido si se repite.
        if ($costo_variable->month == $request->month) {
            $this->validate($request, [
                // Reglas para validacion
                'id_financiero' => 'required|exists:estudios_financieros,id',
                "name" => "required",
                // Se creo un propia validacion.
                "month" => "required|integer",
                "amount" => "required|decimal:0,2"
            ]);
            // De lo contrario valido que no se repita.
        } else {
            // Validacion para agregar un costo fijo
            $this->validate($request, [
                // Reglas para validacion
                'id_financiero' => 'required|exists:estudios_financieros,id',
                "name" => "required",
                // Se creo un propia validacion.
                "month" => ["required", "integer", new ValidacionCostosVariables($request->id_financiero)],
                "amount" => "required|decimal:0,2"
            ]);
        }
        // Sacar la diferencia entre el nuevo valor y el que ya tengo.
        $total = $costo_variable->amount - $request->amount;
        // Modifico el costo variable
        $costo_variable->id_financiero = $request->id_financiero;
        $costo_variable->name = $request->name;
        $costo_variable->month = $request->month;
        $costo_variable->amount = $request->amount;
        $costo_variable->save();
        // Hacemos la modificacion en estudio financiero en total de costos variables.
        $estudio = $costo_variable->estudio_finaciero;
        $estudio->Total_Costos_Variables -= $total;
        $estudio->save();
        return redirect()->route('costos_variables.index')->with('success', 'Se modifico un costo variable');
    }

    /**
     *  Metodo para eliminar un costo variable
     */
    public function destroy($id)
    {
        // busco el id que me envie
        $costo_variable = Costo_Variable::find($id);
        // Obtengo el estudio financiero que corresponda
        $estudio = $costo_variable->estudio_finaciero;
        // Hago el descuento del costo variable eliminado
        $estudio->Total_Costos_Variables -= $costo_variable->amount;
        // Hago la actualizacion
        $estudio->save();
        // Elimino el costo variable
        $costo_variable->delete();
        // Lo redirecciono a la tabla y le envio un mensaje de que se borro correctamente
        return redirect()->route('costos_variables.index')->with('success', 'Se elimino exitosamente un costo variable');
    }
}
