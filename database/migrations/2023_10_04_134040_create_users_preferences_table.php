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
        Schema::create('users_preferences', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('source_preferences')->nullable();
            $table->string('author_preferences');
            $table->string('category_preferences');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_preferences');
    }
};
