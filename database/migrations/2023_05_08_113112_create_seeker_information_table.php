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
            $table->date('birthdate');
            $table->string('gender');
            $table->foreignId('desired_position');
            $table->foreignId('current_position');
            $table->string('desired_country');
            $table->string('desired_city');
            $table->text('more_info');
            $table->foreignId('experience_id');
            $table->text('cover_letter');
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
