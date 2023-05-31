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
        Schema::create('seeker_information', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->foreignId('user_id');
            $table->date('birthdate');
            $table->string('gender');
            $table->string('desired_position');
            $table->string('current_position')->nullable();
            $table->string('desired_country')->nullable();
            $table->string('desired_city')->nullable();
            $table->text('more_info')->nullable();
            $table->text('cover_letter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seeker_information');
    }
};
