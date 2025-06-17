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
        Schema::create('log_integracao', function (Blueprint $table) {
            $table->id();
            $table->string('endpoint');
            $table->string('metodo', 10);
            $table->json('payload')->nullable();
            $table->json('resposta')->nullable();
            $table->unsignedSmallInteger('status_http')->nullable();
            $table->text('erro')->nullable();
            $table->timestamp('criado_em')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_integracao');
    }
};
