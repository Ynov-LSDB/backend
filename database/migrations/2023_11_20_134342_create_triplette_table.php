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
        Schema::create('triplettes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_user_id_1')->constrained('users'); //creator
            $table->foreignId('user_id_2')->constrained('users')->nullable();
            $table->foreignId('user_id_3')->constrained('users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triplette');
    }
};
