<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('interventions', 'statut')) {
            Schema::table('interventions', function (Blueprint $table) {
                $table->string('statut')
                    ->default('En cours')
                    ->after('date_intervention');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('interventions', 'statut')) {
            Schema::table('interventions', function (Blueprint $table) {
                $table->dropColumn('statut');
            });
        }
    }
};