<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('incidents', function (Blueprint $table) {

            $table->text('explication_ia')->nullable()->after('score_ia');

            $table->json('mots_cles')->nullable()->after('explication_ia');

        });
    }

    public function down(): void
    {
        Schema::table('incidents', function (Blueprint $table) {

            $table->dropColumn([
                'explication_ia',
                'mots_cles'
            ]);

        });
    }
};