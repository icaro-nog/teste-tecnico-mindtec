<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('pacientes')->get()->each(function ($paciente) {
            $cpfLimpo = preg_replace('/\D/', '', $paciente->cpf);
            DB::table('pacientes')->where('id', $paciente->id)->update([
                'cpf' => $cpfLimpo,
            ]);
        });
        
        DB::table('responsaveis')->get()->each(function ($responsavel) {
            $cpfLimpo = preg_replace('/\D/', '', $responsavel->cpf);
            DB::table('responsaveis')->where('id', $responsavel->id)->update([
                'cpf' => $cpfLimpo,
            ]);
        });

        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('cpf', 11)->change();
        });
    }

    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('cpf', 14)->change();
        });
    }
};
