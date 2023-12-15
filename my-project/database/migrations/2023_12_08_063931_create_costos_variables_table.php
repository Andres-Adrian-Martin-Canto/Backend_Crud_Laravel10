<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('costos_variables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_financiero')
            // Tengo que especificar la tabla y el cual columna sera vinculada.
            // Porque no sigue la creacion de plurar de las migraciones.
                ->constrained('estudios_financieros')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name');
            $table->integer('month');
            $table->decimal('amount', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costos_variables');
    }
};
