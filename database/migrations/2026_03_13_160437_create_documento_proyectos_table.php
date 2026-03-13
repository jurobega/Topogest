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
        Schema::create('documentos_proyecto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('proyectos')->cascadeOnDelete();
            $table->foreignId('subido_por')->constrained('users')->cascadeOnDelete();
            $table->string('nombre_archivo');
            $table->string('path', 500);
            $table->enum('tipo', ['documento', 'entregable', 'otro'])->default('documento');
            $table->string('mime_type', 100)->nullable();
            $table->integer('size_bytes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_proyecto');
    }
};
