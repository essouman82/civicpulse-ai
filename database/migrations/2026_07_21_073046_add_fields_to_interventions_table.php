<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('interventions', function (Blueprint $table) {

            $table->foreignId('incident_id')
                  ->after('id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('agent');

            $table->text('description');

            $table->date('date_intervention');

        });
    }

    public function down(): void
    {
        Schema::table('interventions', function (Blueprint $table) {

            $table->dropForeign(['incident_id']);
            $table->dropColumn([
                'incident_id',
                'agent',
                'description',
                'date_intervention'
            ]);

        });
    }
};