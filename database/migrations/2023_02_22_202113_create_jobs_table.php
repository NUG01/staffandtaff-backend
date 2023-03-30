<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('establishment_id');
            $table->string('position');
            $table->integer('salary');
            $table->tinyText('currency');
            $table->tinyInteger('type_of_contract');
            $table->tinyInteger('type_of_attendance');
            $table->tinyInteger('period_type');
            $table->tinyInteger('availability')->default(0);
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date');
            $table->string('country_code');
            $table->string('city_name');
            $table->decimal('longitude', 11, 8);
            $table->decimal('latitude', 11, 8);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
