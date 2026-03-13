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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('perfiles_empresa')->cascadeOnDelete();
            $table->foreignId('cliente_id')->nullable()->constrained('perfiles_cliente')->nullOnDelete();
            $table->foreignId('solicitud_id')->nullable()->constrained('solicitudes')->nullOnDelete();
            $table->enum('tipo', ['interno', 'externo'])->default('interno');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['borrador', 'pendiente_aceptacion', 'activo', 'entregado', 'cerrado', 'rechazado'])->default('borrador');
            $table->string('cliente_externo_nombre')->nullable();
            $table->string('cliente_externo_telefono', 20)->nullable();
            $table->string('cliente_externo_email')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin_prevista')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
