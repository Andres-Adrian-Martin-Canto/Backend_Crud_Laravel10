<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Costo_Variable extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_financiero',
        'name',
        'month',
        'amount',
    ];
    protected $table = 'costos_variables';
    public function estudio_finaciero(): BelongsTo
    {
        return $this->belongsTo(Estudio_Finaciero::class, 'id_financiero');
    }
}
