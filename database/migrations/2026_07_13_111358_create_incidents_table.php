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
    Schema::create('incidents', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        $table->string('titre');
        $table->text('description');

        $table->string('categorie');

        $table->string('photo')->nullable();

        $table->decimal('latitude', 10, 7)->nullable();
        $table->decimal('longitude', 10, 7)->nullable();

        $table->enum('priorite', [
            'Faible',
            'Moyenne',
            'Élevée',
            'Critique'
        ])->default('Moyenne');

        $table->enum('statut', [
            'Signalé',
            'En cours',
            'Résolu'
        ])->default('Signalé');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
