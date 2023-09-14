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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users')->nullable(false);
            $table->char('type', 3)->nullable(false);
            $table->boolean('is_approve')->nullable(true);
            $table->timestamp('waktu')->nullable(false);

            $table->foreign('id_users', 'fk-presences-id_users')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->dropForeign('fk-presences-id_users');
        });

        Schema::dropIfExists('presences');
    }
};
