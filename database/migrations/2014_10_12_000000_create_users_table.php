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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('imageURL_fav_balls')->nullable();
            $table->text('imageURL_profile')->nullable();
            $table->string('fav_balls_name')->nullable();
            $table->integer('rank_id')->default(1);
            $table->date('birth_date');
            $table->foreignIdFor(\App\Models\Drink::class, 'fav_drink_id')->nullable();
            $table->foreignIdFor(\App\Models\User::class, 'doublette_user_id')->nullable();
            $table->foreignIdFor(\App\Models\Triplette::class, 'triplette_id')->nullable();
            $table->foreignIdFor(\App\Models\Quadrette::class, 'quadrette_id')->nullable();
            $table->foreignIdFor(\App\Models\Role::class, 'role_id')->nullable();
            $table->string('status')->default('OK');
            $table->integer('score')->default(0);
            $table->string('refresh_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
