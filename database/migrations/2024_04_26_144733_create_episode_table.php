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
        Schema::create('episode', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('number');
            $table->boolean('watched')->default(false);
            $table->foreignId('seasons_id')->constrained()->onDelete('cascade');
            $table->foreignId('series_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episode');
    }
};
