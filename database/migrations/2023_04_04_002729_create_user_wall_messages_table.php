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
        Schema::create('user_wall_messages', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('owner_id')
                ->comment('The user who wrote the message')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreignUuid('user_id')
                ->comment('The user who received the message')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('user_wall_messages');
    }
};
