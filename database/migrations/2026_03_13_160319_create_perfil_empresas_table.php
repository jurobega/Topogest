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
        Schema::create('perfiles_empresa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nombre_fiscal');
            $table->string('nif_cif', 20);
            $table->text('descripcion')->nullable();
            $table->string('provincia', 100);
            $table->string('telefono', 20)->nullable();
            $table->string('logo_path')->nullable();
            $table->boolean('visible_directorio')->default(true);
            $table->string('web')->nullable();
            $table->unsignedTinyInteger('anios_experiencia')->nullable();
            $table->text('zona_actuacion')->nullable();
            $table->unsignedInteger('numero_proyectos')->nullable();
            $table->string('horario_atencion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfiles_empresa');
    }
};
