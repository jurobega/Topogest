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
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('proyectos')->cascadeOnDelete();
            $table->string('numero', 30)->unique();
            $table->enum('estado', ['borrador', 'enviado', 'aceptado', 'rechazado', 'caducado'])->default('borrador');
            $table->date('fecha_emision');
            $table->date('fecha_caducidad')->nullable();
            $table->decimal('base_imponible', 10, 2);
            $table->decimal('iva_porcentaje', 4, 2)->default(21.00);
            $table->decimal('total', 10, 2);
            $table->string('pdf_path', 500)->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presupuestos');
    }
};
