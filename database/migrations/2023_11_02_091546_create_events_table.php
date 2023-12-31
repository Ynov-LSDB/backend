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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('date');
            $table->text('imageURL')->nullable();
            $table->float('price');
            $table->foreignIdFor(\App\Models\Category::class, 'category_id')->nullable();
            $table->string('adresse');
            $table->boolean('is_food_on_site')->default(false);
            $table->integer('registered_limit');
            $table->string('team_style');
            $table->boolean('is_closed')->default(false);
            $table->string('status')->default('OK')->nullable();
            $table->foreignIdFor(\App\Models\User::class,'creator_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
