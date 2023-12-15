<?php

namespace App\Rules;


use App\Models\Estudio_Finaciero;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidacionCostosFijos implements ValidationRule
{
    protected $id_financiero;

    public function __construct($id_financiero)
    {
        $this->id_financiero = $id_financiero;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Busco el estudiio financiero por el id
        $estudio = Estudio_Finaciero::find($this->id_financiero);
        // Luego todos los costos fijos que estan asociados se los envio a mi
        // variable $costos_fijos
        $costos_fijos = $estudio->costos_fijos;
        /**
         * Luego recorro todos los costos fijos para encontrar si
         * ya esta ocupado ese mes.
         */
        foreach ($costos_fijos as $costo_fijo) {
            // Si lo encuentra regresa un error.
            if($costo_fijo->month == $value) {
                $fail("Ese mes ya esta ocupado por otro costo fijo");
            }
        }
    }
}
