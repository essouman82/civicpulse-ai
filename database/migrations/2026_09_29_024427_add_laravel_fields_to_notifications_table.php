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
    Schema::table('notifications', function (Blueprint $table) {
        $table->string('type')->after('id');
        $table->string('notifiable_type')->after('type');
        $table->unsignedBigInteger('notifiable_id')->after('notifiable_type');
        $table->text('data')->after('notifiable_id');
        $table->timestamp('read_at')->nullable()->after('data');

        $table->index(
            ['notifiable_type', 'notifiable_id'],
            'notifications_notifiable_index'
        );
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('notifications', function (Blueprint $table) {
        $table->dropIndex('notifications_notifiable_index');
        $table->dropColumn([
            'type',
            'notifiable_type',
            'notifiable_id',
            'data',
            'read_at',
        ]);
    });
}
};
