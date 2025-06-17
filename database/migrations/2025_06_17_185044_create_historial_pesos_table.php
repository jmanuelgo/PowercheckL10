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
        Schema::create('historial_pesos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atleta_id')->constrained('atletas')->onDelete('cascade');
            $table->decimal('peso', 5, 2);
            $table->date('fecha')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_pesos');
    }
};
