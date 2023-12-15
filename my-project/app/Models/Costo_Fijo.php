<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Costo_Fijo extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_financiero',
        'name',
        'month',
        'amount',
    ];

    protected $table = 'costos_fijos';

    public function estudio_finaciero(): BelongsTo{
        /**
         * Un costoFijo pertenece a un estudioFinanciero
         */
        return $this->belongsTo(Estudio_Finaciero::class,'id_financiero');
    }
}
