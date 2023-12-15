<?php

namespace App\Http\Controllers;

use App\Models\Costo_Fijo;
use App\Rules\ValidacionCostosFijos;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class costos_fijosApi extends Controller
{
    /**
     * Metodo para mostrar todos mis costos Fijos
     */
    public function index()
    {
        // Busco todos los costos fijos
        $costos_fijos =  new Costo_Fijo;
        // se los envio.
        return $costos_fijos::all();
    }

    /**
     * Metodo para crear un nuevo costo fijo.
     */
    public function store(Request $request)
    {
        // Mando los valores que me enviaron a validar a un metodo
        $validator = $this->validarDatos($request);
        // Pregunta a validator la variable si hubo un error
        if ($validator->fails()) {
            // Si hubo un error los manda a mostrar.
            return response()->json($validator->errors());
        }
        // De lo contrario dejara agregar y se guadaran.
        $costo_fijo =  new Costo_Fijo;
        $costo_fijo->id_financiero = $request->id_financiero;
        $costo_fijo->name = $request->name;
        $costo_fijo->month = $request->month;
        $costo_fijo->amount = $request->amount;
        $costo_fijo->save();

        /**
         * Suma la cantidad que ya tiene total_costos_fijos mas
         * el nuevo valor que viene del nuevo costo fijo.
         */
        $estudio = $costo_fijo->estudio_finaciero;
        $estudio->Total_Costos_Fijos += $costo_fijo->amount;
        $estudio->save();
        // Envio un mensaje de que se agrego correctamente
        return response()->json('Se agrego correctamente');
    }

    /**
     * Mostrar un costo fijo en especifico.
     */
    public function show(string $id)
    {
        // Busco el id especial que quiera.
        $costo_fijo = Costo_Fijo::find($id);
        // Pregunto si existe
        if ($costo_fijo) {
            // Si existe el envio la respuesta
            return response()->json($costo_fijo);
        }
        // De lo contrario muestra que no se encontro.
        return response()->json('No se encontro el id que proporcionaste');
    }


    /**
     * Actualiza un costo fijo
     */
    public function update(Request $request, string $id)
    {
        // Busco el costo fijo.
        $costo_fijo = Costo_Fijo::find($id);
        if ($costo_fijo) {
            // Si me envia el mismo mes solo validare los otros
            if ($costo_fijo->month == $request->month) {
                $validator = Validator::make(
                    // Aqui van todo los que quiero que valide
                    $request->all(),
                    [
                        // Reglas para validacion
                        'id_financiero' => 'required|exists:estudios_financieros,id',
                        "name" => "required",
                        "month" => ["required", "integer"],
                        "amount" => "required|decimal:0,2"
                    ]
                );
                // Si hubo un error los manda a mostrar.
                if ($validator->fails()) {
                    return response()->json($validator->errors());
                }
                // De lo contrario hace el insert.
                return response()->json($this->updateCosto($costo_fijo, $request));
            }
            // Si no es el mismo mes pues hace esto.
            // Mando los valores que me enviaron a validar a un metodo
            $validator = $this->validarDatos($request);
            // Pregunta a validator la variable si hubo un error
            if ($validator->fails()) {
                // Si hubo un error los manda a mostrar.
                return response()->json($validator->errors());
            }
            // De lo contrario hace el insert.
            return response()->json($this->updateCosto($costo_fijo, $request));
        }
        // Si no se encuentra id muestra que no se encontro.
        return response()->json('No se encontro el id que proporcionaste');
    }


    /**
     *  Metodo para eliminar un costo fijo.
     */
    public function destroy(string $id)
    {
        // Busco el id en mi base de datos.
        $costo_fijo = Costo_Fijo::find($id);
        // Si existe hace la eliminacion.
        if ($costo_fijo) {
            // Buscamos a cual estudio financiero esta relacionado
            $estudio = $costo_fijo->estudio_finaciero;
            // Se lo restamos a total costos fijos.
            $estudio->Total_Costos_Fijos -= $costo_fijo->amount;
            // Guardamos los cambios de estudio.
            $estudio->save();
            // Eliminamos el costo fijo.
            $costo_fijo->delete();
            // Le envio que se elimino el costo
            return response()->json('Se Elimino');
        }
        // De lo contrario regresara no existe
        return response()->json('No se encontro el id que proporcionaste');
    }


    /**
     * Validacion para saber si el mes que proporciono se repite
     * con los que ya estan en la misma instancia.
     */
    public function validarDatos(Request $request)
    {
        // Validacion de costo fijos
        return Validator::make(
            // Aqui van todo los que quiero que valide
            $request->all(),
            [
                // Reglas para validacion
                'id_financiero' => 'required|exists:estudios_financieros,id',
                "name" => "required",
                // Se creo un propia validacion.
                "month" => ["required", "integer", new ValidacionCostosFijos($request->id_financiero)],
                "amount" => "required|decimal:0,2"
            ]
        );
    }

    /**
     * Metodo que hace el insert dependiendo si el costo
     * es el mismo o no ya que se debe actualizar el total costos fijos.
     */
    public function updateCosto($costo_fijo, Request $request)
    {
        $costo_fijo->name = $request->name;
        // Si el amount es el mismo que me envian no lo modifico
        if ($costo_fijo->amount == $request->amount) {
            // Modificamos solo los otros campos
            $costo_fijo->month = $request->month;
            $costo_fijo->save();
            return 'Se modifico pero no el amount';
        } else{
            // Si no es la misma amount entonces se hace las modificaciones.
            // Se saca la diferencia que hay entre el amount que ya teniamos
            // por el que recibimos
            $total = $costo_fijo->amount - $request->amount;
            $costo_fijo->amount = $request->amount;
            // Hacemos la modificacion
            $costo_fijo->save();
            // Hacemos la modificacion en estudio financiero.
            $estudio = $costo_fijo->estudio_finaciero;
            $estudio->Total_Costos_Fijos -= $total;
            $estudio->save();
        }
        return 'Se modifico todo';
    }
}
