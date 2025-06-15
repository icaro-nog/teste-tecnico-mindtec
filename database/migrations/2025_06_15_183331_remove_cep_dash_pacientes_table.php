<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('pacientes')->get()->each(function ($paciente) {
            $cepLimpo = preg_replace('/\D/', '', $paciente->cep);
            DB::table('pacientes')->where('id', $paciente->id)->update([
                'cep' => $cepLimpo,
            ]);
        });

        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('cep', 8)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('cep', 9)->change();
        });
    }
};
