<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_wall_messages', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('owner_id')
                ->comment('The user who created the message')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreignUuid('event_id')
                ->comment('The event the message belongs to')
                ->references('id')
                ->on('events')
                ->cascadeOnDelete();

            $table->text('message');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_wall_messages');
    }
};
