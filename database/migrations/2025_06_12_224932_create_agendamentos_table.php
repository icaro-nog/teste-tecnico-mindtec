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
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->string('nome_medico', 100);
            $table->string('crm_medico', 7);
            $table->string('cidade_medico', 100);
            $table->char('uf_medico', 2);
            $table->string('especialidade', 100);
            $table->dateTime('data_hora');
            $table->enum('status', ['1', '2', '3']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
