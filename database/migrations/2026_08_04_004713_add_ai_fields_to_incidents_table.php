<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('incidents', function (Blueprint $table) {

            $table->string('service')->nullable()->after('priorite');

            $table->integer('score_ia')->default(0)->after('service');

        });
    }

    public function down(): void
    {
        Schema::table('incidents', function (Blueprint $table) {

            $table->dropColumn(['service','score_ia']);

        });
    }
};