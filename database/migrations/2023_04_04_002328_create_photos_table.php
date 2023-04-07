<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')
                ->comment('The user who uploaded the photo')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreignUuid('event_id')
                ->comment('The event the photo belongs to')
                ->references('id')
                ->on('events')
                ->cascadeOnDelete();

            $table->string('path');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
