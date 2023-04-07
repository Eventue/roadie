<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')
                ->comment('The user who created the event')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->string('image_url');
            $table->text('location');
            $table->dateTime('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
