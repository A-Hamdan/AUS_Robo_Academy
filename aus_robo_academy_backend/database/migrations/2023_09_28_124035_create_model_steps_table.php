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
        Schema::create('model_steps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('model_id');
            $table->string('title', 100);
            $table->text('description');
            $table->string('image');
            $table->string('mtl')->nullable();
            $table->string('obj')->nullable();
            $table->boolean('is_active')->default(false);
            $table->bigInteger('position')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_steps');
    }
};
