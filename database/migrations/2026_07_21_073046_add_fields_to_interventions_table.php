<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Cette migration est conservée pour préserver l'historique
     * des migrations du projet.
     *
     * Les champs incident_id, agent, description et
     * date_intervention sont déjà créés dans
     * create_interventions_table.
     */
    public function up(): void
    {
        //
    }

    /**
     * Annulation de la migration.
     */
    public function down(): void
    {
        //
    }
};