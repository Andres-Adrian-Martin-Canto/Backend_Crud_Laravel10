<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudio_Finaciero extends Model
{
    use HasFactory;
    protected $table = 'estudios_financieros';
    protected $fillable = [
        'name',
        'descripcion',
        'Total_Costos_Fijos',
        'Total_Costos_Variables'];

    /**
     * Aqui puedes buscar los datos relacionados,
     * en este caso buscara los que pertenecen al
     * estudio financiero
     */
    public function costos_fijos(): HasMany{
        /**
         * Estoy diciendo que Estudio_Financiero tiene
         * muchos costos fijos.
         * y si le envio el id_financiero me traer las relaciones.
         * El id_financiero es la llave foranea de la tabla
         * costos_fijos
         */
        return $this->hasMany(Costo_Fijo::class,'id_financiero');
    }

    public function costos_variables(): HasMany
    {
        return $this->hasMany(Costo_Variable::class, 'id_financiero');
    }
}
